<?php

namespace App\Http\Requests;

use App\Link;
use App\Portfolio;
use App\Project;
use Symfony\Component\HttpFoundation\Request;
use TiMacDonald\Validation\Rule;

final class LinkRequest extends BaseFormRequest
{
    private $projectSubtypes = [
        'links' => Link::SUBTYPE_PROJECT_OTHER,
        'reports' => Link::SUBTYPE_PROJECT_REPORT,
    ];

    private $portfolioSubtypes = [
        'goals' => Link::SUBTYPE_PORTFOLIO_GOAL,
        'reports' => Link::SUBTYPE_PORTFOLIO_REPORT,
        'links' => Link::SUBTYPE_PORTFOLIO_OTHER,
    ];

    public function rules()
    {
        $this->parseAdditionalInfo();
        if ($this->method() == Request::METHOD_GET || $this->method() == Request::METHOD_DELETE) {
            return [];
        } else {
            return [
                'title' => Rule::required()->string(1, Link::DD_TITLE_LENGTH)->get(),
                'url' => Rule::required()->url(Link::DD_URL_LENGTH)->get(),
                'sort_order' => Rule::integer(0, Link::DD_SORT_ORDER_MAX)->get(),
            ];
        }
    }

    private function parseAdditionalInfo()
    {
        $nameParts = explode('.', $this->route()->getName());
        $this->routeGroup = $nameParts[0];
        $this->routeType = $nameParts[1];
        $this->routeAction = $nameParts[2];

        if ($this->routeGroup == 'projects') {
            $this->holdingModel = Project::findOrFailByHashid($this->project);
            $this->routeSubtype = $this->projectSubtypes[$this->routeType];
        } elseif ($this->routeGroup == 'portfolios') {
            $this->holdingModel = Portfolio::findOrFailByHashid($this->portfolio);
            $this->routeSubtype = $this->portfolioSubtypes[$this->routeType];
        }
    }
}
