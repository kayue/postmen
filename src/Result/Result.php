<?php

namespace Kayue\Postmen\Result;

class Result
{
    const STATUS_OK = 200;

    protected $meta;
    protected $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    public function getMeta()
    {
        return $this->meta;
    }
}
