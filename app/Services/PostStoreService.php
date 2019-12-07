<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostStoreService
{
    private $posts;
    const IMAGE_PATH = 'public/images';

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function handle($request)
    {

        /*
                if($request['image'])
                {
                    // handle
                    // but this not correct
                    // you may write this code more than 2 times
                }
        */


        $this->posts->create(
        // override image

            array_merge($request, [
                'image' => $this->handleFileUpload($request['image'])->getFileName()
            ])
        );

        return response(null, 201);

    }

    protected function handleFileUpload($file)
    {
        return (new LocalFileUploadService($file))->save(self::IMAGE_PATH);
    }

}