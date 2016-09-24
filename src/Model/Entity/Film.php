<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Film Entity
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property int $allocine_code
 * @property string $directors
 * @property string $actors
 * @property string $path
 * @property string $poster
 * @property string $allocine_link
 * @property bool $to_verify
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Film extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
