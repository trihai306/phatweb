<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disk mặc định của Filament
    |--------------------------------------------------------------------------
    |
    | Mặc định của package là env('FILESYSTEM_DISK', 'local'). Vì .env đặt
    | FILESYSTEM_DISK=local nên ImageColumn/FileUpload đi tìm file trong
    | storage/app/private, trong khi toàn bộ ảnh nằm ở storage/app/public
    | (disk 'public'). Hệ quả: ImageColumn kiểm tra exists() thất bại và
    | render ô trống, còn file upload mới thì lưu vào chỗ web không đọc được.
    |
    | Ghim riêng disk của Filament về 'public', không đụng FILESYSTEM_DISK
    | mặc định của ứng dụng. File này được mergeConfigFrom với config gốc
    | của package nên các key khác vẫn giữ nguyên giá trị mặc định.
    |
    */

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

];
