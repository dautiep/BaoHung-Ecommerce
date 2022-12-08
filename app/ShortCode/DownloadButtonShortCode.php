<?php

namespace App\ShortCode;

use App\Repositories\QuestionAswerServiceRepository;

class DownloadButtonShortCode
{
    const short_code_name = 'button-download';
    /*
        Shortcode register in providers
    */
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $html = '';
        $attach_files = '';
        if (!empty(@$shortcode->data)) {
            $builder = $this->getAttachFiles($shortcode->data);
            $attach_files =  $builder->attach_files;
        }
        if (!empty($attach_files)) {
            $html = '<a class="btn btn-sm btn-info text-left" style="justify-content: flex-end" ' . "href='$attach_files'" . 'download> Tên file</a>';
        }
        return $html;
    }

    public function getAttachFiles($id)
    {
        return app(QuestionAswerServiceRepository::class)->find($id);
    }
}
