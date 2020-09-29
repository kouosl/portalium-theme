<?php
namespace portalium\theme\widgets;

class Portlet extends \yii\bootstrap\Widget
{
    public $actions = [];
    public $title;
    public $subTitle;
    public $icon;
    public $headerOptions = [];
    public $bodyOptions = [];

    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'portlet');
        echo Html::beginTag('div', $this->options);
        $this->_renderTitle();
        Html::addCssClass($this->bodyOptions, 'portlet-body');
        echo Html::beginTag('div', $this->bodyOptions);
    }

    private function _renderTitle()
    {
        if (false !== $this->title)
        {
            Html::addCssClass($this->headerOptions, 'portlet-title');
            echo Html::beginTag('div', $this->headerOptions);
            echo Html::beginTag('div', ['class' => 'caption']);
            if ($this->icon)
            {
                echo Html::tag('i', '', ['class' => $this->icon]);
            }
            echo Html::tag('span', $this->title, ['class' => 'caption-subject text-uppercase']);
            if ($this->subTitle)
            {
                echo Html::tag('span', $this->subTitle, ['class' => 'caption-helper']);
            }

            echo Html::endTag('div');
            $this->_renderActions();
            echo Html::endTag('div');
        }
    }

    private function _renderActions()
    {
        if (!empty($this->actions))
        {
            echo Html::tag('div', implode("\n", $this->actions), ['class' => 'actions']);
        }
    }

    public function run()
    {
        echo Html::endTag('div'); // End portlet body
        echo Html::endTag('div'); // End portlet div
    }
}