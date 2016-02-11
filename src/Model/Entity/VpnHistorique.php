<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VpnHistorique Entity.
 *
 * @property int $id
 * @property int $time
 * @property string $action
 * @property string $real_ip
 * @property int $vpn_compte_id
 * @property \App\Model\Entity\VpnCompte $vpn_compte
 */
class VpnHistorique extends Entity
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
        'id' => false,
    ];
}
