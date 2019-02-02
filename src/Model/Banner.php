<?php
namespace SK\Banner\Model;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "banners".
 *
 * @property integer $banner_id
 * @property string $name
 * @property string $comment
 * @property string $code
 * @property timestamp $start_at
 * @property timestamp $end_at
 * @property boolean $desktop
 * @property boolean $mobile
 * @property boolean $enabled
 * @property timestamp $updated_at
 * @property timestamp $created_at
 */
class Banner extends ActiveRecord implements ToggleableInterface
{
    use ToggleableTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['name', 'comment', 'code'], 'string'],
            [['enabled', 'desktop', 'mobile'], 'boolean'],
            [['start_at', 'end_at', 'updated_at', 'created_at'], 'safe'],
        ];
    }

    /**
     * Find banner by name
     *
     * @param string $name Banener name.
     *
     * @return Banner|null
     */
    public static function findByName($name)
    {
        return static::find()
            ->select(['name', 'code', 'desktop', 'mobile', 'start_at', 'end_at'])
            ->where(['name' => (string) $name, 'enabled' => 1])
            ->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->banner_id;
    }
}
