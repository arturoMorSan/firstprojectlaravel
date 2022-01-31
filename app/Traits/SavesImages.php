<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Image;

trait SavesImages
{
    /**
     * Fetch the save settings for an uploaded image.
     *
     * @param  string $type
     * @return array
     */
    protected function getImageConfig($type)
    {
        $settings = [
            'default' => [
                'height' => 2000,
                'width'  => 2000,
                'path'   => storage_path('app/public/produccion/')
            ],
            'news' => [
                'width'  => 1100,
                'height' => null,
                'path'   => storage_path('app/public/noticias/'),
                'constraints' => ['aspectRatio']
            ],

            'directory' => [
                'width'  => 340,
                'height' => null,
                'path'   => storage_path('app/public/directorio/'),
                'constraints' => ['aspectRatio']
            ],
            'newsThumb' => [
                'width'    => 450,
                'height'   => null,
                'filename' => '{name}-sm',
                'path'     => storage_path('app/public/noticias/')
            ],
            'publicationThumbSm' => [
                'width'    => null,
                'height'   => 300,
                'filename' => date('YmdHis') . '-{name}-md',
                'path'     => storage_path('app/public/produccion/')
            ],
            'publicationThumbMd' => [
                'width'    => null,
                'height'   => 370,
                'filename' => date('YmdHis') . '-{name}-sm',
                'path'     => storage_path('app/public/produccion/')
            ]
        ];

        return $settings[$type] ?? $settings['default'];
    }


    /**
     * Store the uploaded image.
     *
     * @param  \Illuminate\Http\UploadedFile $image
     * @param  string $type
     * @param  string $filename
     * @return array
     */
    protected function saveImage($image, $type = 'default', $filename = '')
    {
        ini_set('memory_limit', '256M');

        $config = $this->getImageConfig($type);
        $pathInfo = pathinfo($image->getClientOriginalName());
        $filename = $filename ?: Str::slug($pathInfo['filename']);

        if (array_key_exists('filename', $config)) {
            $fullname = str_replace('{name}', $filename, $config['filename']) . '.' . $pathInfo['extension'];
        }
        else {
            $fullname = $filename . '.' . $pathInfo['extension'];
        }

        $savedImage = Image::make($image)
            ->resize($config['width'], $config['height'], function ($constraint) use($config) {
                if (key_exists('constraints', $config)) {
                    foreach ($config['constraints'] as $rule) {
                        $constraint->{$rule}();
                    }
                }
                else {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                }
            })
            ->save($config['path'] . $fullname, 80);

        return [
            'filename' => $fullname,
            'width'    => $savedImage->width(),
            'height'   => $savedImage->height()
        ];
    }
}
