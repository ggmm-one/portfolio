<?php

namespace App\Http\Requests;

use App\Comment;
use App\PortfolioUnit;
use App\Project;
use Symfony\Component\HttpFoundation\Request;
use TiMacDonald\Validation\Rule;

final class CommentRequest extends BaseFormRequest
{
    public function rules()
    {
        $this->parseAdditionalInfo();
        if ($this->method() == Request::METHOD_GET || $this->method() == Request::METHOD_DELETE) {
            return [];
        } else {
            return ['content' => Rule::required()->string(1, Comment::DD_CONTENT_LENGTH)->get()];
        }
    }

    private function parseAdditionalInfo()
    {
        $this->routeGroup = explode('.', $this->route()->getName())[0];

        if ($this->routeGroup == 'projects') {
            $this->holdingModel = Project::findOrFailByHashid($this->project);
        } elseif ($this->routeGroup == 'portfolio_units') {
            $this->holdingModel = PortfolioUnit::findOrFailByHashid($this->portfolio_unit);
        }
    }
}
