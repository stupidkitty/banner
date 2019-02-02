<?php
namespace SK\Banner\Form;

use yii\base\Model;
use yii\helpers\StringHelper;

/**
 * Модель для обработки формы баннера. Создание, модификация.
 */
class BannerForm extends Model
{
	public $name;
	public $comment;
	public $code;
	public $desktop;
	public $mobile;
	public $start_at;
	public $end_at;
	public $enabled;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->desktop = 1;
        $this->mobile = 1;
        $this->start_at = null;
        $this->end_at = null;
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
    	return '';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'comment', 'code'], 'string'],
            [['desktop', 'mobile', 'enabled'], 'boolean'],
            [['start_at', 'end_at'], 'safe'],

            [['name', 'comment'] , 'filter', 'filter' => function ($attribute) {
                return StringHelper::truncate($attribute, 255, false);
            }],
            [['name', 'comment', 'code'], 'trim'],
            ['start_at', 'default', 'value' => null],
            ['end_at', 'default', 'value' => null],

            [['name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function isValid()
    {
        return $this->validate();
    }
}
