<?php
namespace App\Model\Table;

use App\Model\Entity\VpnCompte;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VpnComptes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $VpnHistorique
 */
class VpnComptesTable extends Table
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

        $this->table('vpn_comptes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('VpnHistorique', [
            'foreignKey' => 'vpn_compte_id'
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
            ->add('bp_used', 'valid', ['rule' => 'numeric'])
            ->requirePresence('bp_used', 'create')
            ->notEmpty('bp_used');

        $validator
            ->add('actif', 'valid', ['rule' => 'boolean'])
            ->requirePresence('actif', 'create')
            ->notEmpty('actif');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    protected function _initializeSchema(\Cake\Database\Schema\TableSchema $table)
    {
        $table->columnType('bp_used', 'string');
        $table->columnType('bp_used_day', 'string');
        return $table;
    }
}
