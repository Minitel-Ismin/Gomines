<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $password
 * @property \App\Model\Entity\VpnCompte[] $vpn_comptes
 */
class User extends Entity
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
	
	public static $tDroits = array(
		"AdminFTP" => 4,
		"Admin" => 2,
		"Utilisateur" => 1
	);
	
	
	protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
	
	public function sDroits(){
		$retour = array();
		foreach($this->tDroits as $v => $k){
			if(($this->droits & $k) != 0)
				$retour[] = $v;
		}
		
		return $retour;
	}
}
