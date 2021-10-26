<?php

namespace Sparkr\Port\Primary\WebApi\Controllers;

use App\Http\Controllers\Controller;
use Sparkr\Utility\ResponseCodes\ApiCodes;
use Sparkr\Port\Primary\WebApi\Traits\HandleResponse;

class BaseController extends Controller
{
    use HandleResponse;

    /*
     * Response Status
     */
    protected $status;

    /*
     * Response Message
     */
    protected $message;

    /*
     * Response Data
     */
    protected $data;

    /**
     * BaseController constructor.
     */
    public function __construct ()
    {
        $this->status = ApiCodes::SOMETHING_WENT_WRONG;
        $this->message = __('api_auth.something_went_wrong');
        $this->data = [];
    }

}
