<?php
namespace App\Model\Table;

use App\Model\Entity\VpnHistorique;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VpnHistorique Model
 *
 * @property \Cake\ORM\Association\BelongsTo $VpnComptes
 */
class VpnHistoriqueTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('vpn_historique');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('VpnComptes', [
            'foreignKey' => 'vpn_compte_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('time', 'valid', ['rule' => 'numeric'])
            ->requirePresence('time', 'create')
            ->notEmpty('time');

        $validator
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        $validator
            ->requirePresence('real_ip', 'create')
            ->notEmpty('real_ip');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['vpn_compte_id'], 'VpnComptes'));
        return $rules;
    }
}
