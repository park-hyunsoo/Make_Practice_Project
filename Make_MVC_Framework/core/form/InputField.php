<?php
namespace app\core\form;
use app\core\Model;

class InputField extends BaseField
{
    public CONST TYPE_TEXT = 'text';
    public CONST TYPE_PASSWORD = 'password';
    public CONST TYPE_NUMBER = 'number';
    
    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control %s">',
            $this->type, 
            $this->attribute, 
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}