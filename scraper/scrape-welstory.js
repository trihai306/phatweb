const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');
const https = require('https');
const http = require('http');
const { URL } = require('url');

// ─── Configuration ────────────────────────────────────────────────────────────
const BASE_URL = 'https://www.welstory.vn';
const OUTPUT_DIR = path.join(__dirname);
const IMAGES_DIR = path.join(__dirname, 'images');
const DATA_FILE = path.join(__dirname, 'data.json');

const PAGES = [
  { url: 'https://www.welstory.vn/index.html',                                    section: 'homepage' },
  { url: 'https://www.welstory.vn/contents/aboutus/welstory.html',                section: 'about' },
  { url: 'https://www.welstory.vn/contents/aboutus/sustainability.html',          section: 'sustainability' },
  { url: 'https://www.welstory.vn/contents/aboutus/vision.html',                  section: 'vision' },
  { url: 'https://www.welstory.vn/contents/aboutus/history.html',                 section: 'history' },
  { url: 'https://www.welstory.vn/contents/aboutus/certificate.html',             section: 'certificate' },
  { url: 'https://www.welstory.vn/contents/aboutus/about01.html',                 section: 'about01' },
  { url: 'https://www.welstory.vn/contents/services/service.html',                section: 'service' },
  { url: 'https://www.welstory.vn/contents/services/north.html',                  section: 'north' },
  { url: 'https://www.welstory.vn/contents/services/south.html',                  section: 'south' },
  { url: 'https://www.welstory.vn/contents/services/midland.html',                section: 'midland' },
  { url: 'https://www.welstory.vn/contents/services/menu.html',                   section: 'menu' },
  { url: 'https://www.welstory.vn/contents/whyus/whyus.html',                     section: 'whyus' },
  { url: 'https://www.welstory.vn/contents/whyus/freshness.html',                 section: 'freshness' },
  { url: 'https://www.welstory.vn/contents/whyus/safety.html',                    section: 'safety' },
  { url: 'https://www.welstory.vn/contents/whyus/tasty.html',                     section: 'tasty' },
  { url: 'https://www.welstory.vn/contents/whyus/customer.html',                  section: 'customer' },
  { url: 'https://www.welstory.vn/contents/careers/hrSystem.html',                section: 'hrSystem' },
  { url: 'https://www.welstory.vn/contents/contactus/offices_v01.html',           section: 'offices' },
  { url: 'https://www.welstory.vn/contents/contactus/inquiry.html',               section: 'inquiry' },
];

// ─── Helpers ──────────────────────────────────────────────────────────────────

function ensureDir(dir) {
  if (!fs.existsSync(dir)) fs.mkdirSync(dir, { recursive: true });
}

function sanitizeFilename(str) {
  return str
    .replace(/[^a-zA-Z0-9._-]/g, '_')
    .replace(/_+/g, '_')
    .replace(/^_|_$/g, '')
    .substring(0, 200);
}

/**
 * Download a file from a URL to a local path.
 * Returns the local filename on success, null on error.
 */
function downloadFile(fileUrl, destPath) {
  return new Promise((resolve) => {
    try {
      const parsedUrl = new URL(fileUrl);
      const proto = parsedUrl.protocol === 'https:' ? https : http;

      const request = proto.get(fileUrl, { timeout: 15000 }, (response) => {
        if (response.statusCode === 301 || response.statusCode === 302) {
          const redirectUrl = response.headers.location;
          if (redirectUrl) {
            downloadFile(redirectUrl, destPath).then(resolve);
          } else {
            resolve(null);
          }
          return;
        }
        if (response.statusCode !== 200) {
          resolve(null);
          return;
        }
        const fileStream = fs.createWriteStream(destPath);
        response.pipe(fileStream);
        fileStream.on('finish', () => { fileStream.close(); resolve(destPath); });
        fileStream.on('error', () => { resolve(null); });
      });
      request.on('error', () => resolve(null));
      request.on('timeout', () => { request.destroy(); resolve(null); });
    } catch (e) {
      resolve(null);
    }
  });
}

/**
 * Convert a possibly-relative image src to an absolute URL.
 * pageUrl is the page that contained the <img> tag.
 */
function resolveUrl(src, pageUrl) {
  try {
    return new URL(src, pageUrl).href;
  } catch {
    return null;
  }
}

/**
 * Download an image from `imgUrl` and save it to IMAGES_DIR.
 * Returns the local filename used, or null if it failed.
 */
async function downloadImage(imgUrl, imageMap) {
  if (!imgUrl) return null;
  if (imageMap[imgUrl]) return imageMap[imgUrl]; // already downloaded

  try {
    const parsed = new URL(imgUrl);
    const ext = path.extname(parsed.pathname) || '.jpg';
    const baseName = sanitizeFilename(parsed.pathname.replace(/\//g, '_')) || `img_${Date.now()}`;
    const filename = baseName.endsWith(ext) ? baseName : `${baseName}${ext}`;
    const destPath = path.join(IMAGES_DIR, filename);

    const result = await downloadFile(imgUrl, destPath);
    if (result) {
      imageMap[imgUrl] = filename;
      return filename;
    }
  } catch (e) {
    // ignore
  }
  return null;
}

// ─── Per-page scraping helpers ────────────────────────────────────────────────

async function extractCommonData(page, pageUrl) {
  return page.evaluate((pUrl) => {
    // Headings
    const headings = [];
    document.querySelectorAll('h1, h2, h3, h4, h5').forEach((el) => {
      const text = el.innerText.trim();
      if (text) headings.push({ tag: el.tagName.toLowerCase(), text });
    });

    // Breadcrumb
    const breadcrumb = [];
    document.querySelectorAll('.breadcrumb li, #breadcrumb li, nav[aria-label="breadcrumb"] li').forEach((el) => {
      const text = el.innerText.trim();
      if (text) breadcrumb.push(text);
    });

    // Sidebar navigation
    const sidebarNav = [];
    document.querySelectorAll('.sub_nav li, .side_nav li, .gnb li, aside li').forEach((el) => {
      const a = el.querySelector('a');
      if (a) {
        sidebarNav.push({ text: a.innerText.trim(), href: a.getAttribute('href') });
      }
    });

    // Main content text
    const contentSelectors = ['.sub_cont', '.content_area', '.main_content', '#content', 'main', '.container'];
    let contentText = '';
    for (const sel of contentSelectors) {
      const el = document.querySelector(sel);
      if (el) { contentText = el.innerText.trim(); break; }
    }
    if (!contentText) contentText = document.body.innerText.trim().substring(0, 5000);

    // All image srcs on page
    const imageSrcs = Array.from(document.querySelectorAll('img')).map((img) => img.getAttribute('src')).filter(Boolean);

    return { headings, breadcrumb, sidebarNav, contentText, imageSrcs };
  }, pageUrl);
}

async function extractHomepage(page) {
  return page.evaluate(() => {
    // Sliders — actual structure: .bxslider > li.item
    const sliders = [];
    document.querySelectorAll('.bxslider li.item, .visual ul li').forEach((el) => {
      const img = el.querySelector('.imgBox img, img');
      const titleEl = el.querySelector('.textBox h4, .textBox h2, .textBox h3');
      const bgColorEl = el.querySelector('.bg_color');
      const bgColor = bgColorEl ? bgColorEl.style.backgroundColor : null;
      sliders.push({
        image: img ? img.getAttribute('src') : null,
        title: titleEl ? titleEl.innerText.trim() : null,
        bg_color: bgColor,
      });
    });

    // Service cards — actual structure: .con01 ul > li > a > img + p
    const serviceCards = [];
    document.querySelectorAll('.con01 ul li').forEach((el) => {
      const link = el.querySelector('a');
      // pc image is the second .pc img; use first img for simplicity
      const imgs = el.querySelectorAll('img');
      const mobileImg = el.querySelector('img.mobile') || imgs[0];
      const pEl = el.querySelector('p');
      const titleNode = pEl ? pEl.childNodes[0] : null;
      const titleText = titleNode ? titleNode.textContent.trim() : null;
      const span = pEl ? pEl.querySelector('span') : null;
      serviceCards.push({
        image: mobileImg ? mobileImg.getAttribute('src') : null,
        title: titleText,
        description: span ? span.innerText.trim() : null,
        href: link ? link.getAttribute('href') : null,
      });
    });

    // Strengths cards — actual structure: .con03 ul > li > a
    const strengthCards = [];
    document.querySelectorAll('.con03 ul li').forEach((el) => {
      const link = el.querySelector('a');
      strengthCards.push({
        title: link ? link.innerText.trim() : el.innerText.trim(),
        href: link ? link.getAttribute('href') : null,
        link_class: link ? link.className : null,
      });
    });

    // Contact info — from .con02 .txt paragraph
    const contactInfo = {};
    const txtEl = document.querySelector('.con02 .txt');
    if (txtEl) {
      const raw = txtEl.innerText.trim();
      contactInfo.raw = raw;
      const lines = raw.split('\n').map((l) => l.trim()).filter(Boolean);
      lines.forEach((line) => {
        if (line.toLowerCase().includes('address') || line.includes('Địa chỉ')) contactInfo.address = line;
        else if (line.includes('điện thoại') || line.includes('Số điện thoại')) contactInfo.phone = line;
        else if (line.includes('@')) contactInfo.email = line;
      });
    }

    // Recruitment and inquiry links — from .con02 .detail ul li
    const links = {};
    document.querySelectorAll('.con02 .detail ul li').forEach((li) => {
      const a = li.querySelector('a');
      const span = li.querySelector('p span');
      if (!a) return;
      const label = span ? span.innerText.trim() : a.innerText.trim();
      const href = a.getAttribute('href');
      if (label.includes('Tuyển dụng') || label.toLowerCase().includes('recruit')) links.recruitment = href;
      if (label.includes('Hỏi trực tuyến') || label.toLowerCase().includes('inquiry')) links.inquiry = href;
    });

    return { sliders, serviceCards, strengthCards, contactInfo, links };
  });
}

async function extractAboutPage(page) {
  return page.evaluate(() => {
    const stats = {};

    // Parse all DL elements — actual structure uses dt/dd pairs
    document.querySelectorAll('dl').forEach((dl) => {
      const dt = dl.querySelector('dt');
      const dd = dl.querySelector('dd');
      if (!dt || !dd) return;
      const key = dt.innerText.trim();
      const value = dd.innerText.trim();
      if (key.includes('Tổng Giám đốc') || key.includes('CEO')) stats.ceo = value;
      else if (key.includes('thành lập') || key.includes('Thành lập') || key.includes('Ngày')) stats.founding_date = value;
      else if (key.includes('Doanh thu') || key.includes('doanh thu')) stats.revenue = value;
      else if (key.includes('nhân viên') || key.includes('Nhân viên') || key.includes('Số lượng nhân')) stats.employees = value;
      else if (key.includes('suất ăn') || key.includes('Số lượng suất')) stats.meals_per_day = value;
      else if (key.includes('kinh doanh') || key.includes('Lĩnh vực')) stats.business_areas = value;
      else if (key.includes('Nhà ăn') || key.includes('nhà ăn')) stats.canteen_count = value;
      else if (key.includes('Trụ sở') || key.includes('trụ sở') || key.includes('HQ')) stats.hq_address = value;
      else stats[key] = value; // catch-all for any other fields
    });

    // Grab all table rows as raw data too
    const tableRows = [];
    document.querySelectorAll('table tr').forEach((tr) => {
      const cells = Array.from(tr.querySelectorAll('th, td')).map((c) => c.innerText.trim());
      if (cells.length) tableRows.push(cells);
    });

    // Intro text
    const intro = document.querySelector('.aboutus01 .txt01');
    if (intro) stats.intro = intro.innerText.trim();

    return { stats, tableRows };
  });
}

// ─── Main ─────────────────────────────────────────────────────────────────────

async function main() {
  ensureDir(IMAGES_DIR);

  const imageMap = {}; // originalUrl -> localFilename
  const result = {
    company_info: {},
    sliders: [],
    pages: [],
    services: [],
    strengths: [],
    statistics: [],
    images_downloaded: [],
    contact_info: {},
    links: {},
  };

  console.log('Launching browser...');
  const browser = await chromium.launch({ headless: true });
  const context = await browser.newContext({
    userAgent:
      'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    ignoreHTTPSErrors: true,
  });

  for (const { url, section } of PAGES) {
    console.log(`\n[${section}] Scraping: ${url}`);
    const page = await context.newPage();

    try {
      await page.goto(url, { waitUntil: 'networkidle', timeout: 30000 });
      await page.waitForTimeout(1500); // let JS render

      // Common extraction
      const common = await extractCommonData(page, url);

      // Resolve and download images
      const pageImages = [];
      for (const src of common.imageSrcs) {
        const absUrl = resolveUrl(src, url);
        if (!absUrl) continue;
        const localFile = await downloadImage(absUrl, imageMap);
        pageImages.push({ original: absUrl, local: localFile });
      }

      const pageData = {
        url,
        section,
        headings: common.headings,
        breadcrumb: common.breadcrumb,
        sidebarNav: common.sidebarNav,
        contentText: common.contentText,
        images: pageImages,
      };

      // Section-specific extraction
      if (section === 'homepage') {
        const homeData = await extractHomepage(page);

        // Resolve slider image URLs
        for (const slide of homeData.sliders) {
          if (slide.image) {
            const absUrl = resolveUrl(slide.image, url);
            slide.image_url = absUrl;
            if (absUrl) {
              slide.image_local = await downloadImage(absUrl, imageMap);
            }
          }
        }

        result.sliders = homeData.sliders;
        result.services = homeData.serviceCards;
        result.strengths = homeData.strengthCards;
        result.contact_info = homeData.contactInfo;
        result.links = homeData.links;
        pageData.homepage_data = homeData;

      } else if (section === 'about') {
        const aboutData = await extractAboutPage(page);
        result.company_info = aboutData;
        result.statistics = aboutData.tableRows;
        pageData.about_data = aboutData;
      }

      result.pages.push(pageData);
      console.log(
        `  Headings: ${common.headings.length}, Images on page: ${common.imageSrcs.length}, Downloaded: ${pageImages.filter((i) => i.local).length}`
      );
    } catch (err) {
      console.error(`  ERROR on ${url}: ${err.message}`);
      result.pages.push({ url, section, error: err.message });
    } finally {
      await page.close();
    }
  }

  await browser.close();

  // Compile images_downloaded list
  result.images_downloaded = Object.entries(imageMap).map(([original, local]) => ({ original, local }));

  // Write data.json
  fs.writeFileSync(DATA_FILE, JSON.stringify(result, null, 2), 'utf-8');
  console.log(`\nDone! Data saved to: ${DATA_FILE}`);
  console.log(`Total images downloaded: ${result.images_downloaded.length}`);
  console.log(`Total pages scraped: ${result.pages.length}`);
}

main().catch((err) => {
  console.error('Fatal error:', err);
  process.exit(1);
});
