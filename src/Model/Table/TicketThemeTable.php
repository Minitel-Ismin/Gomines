<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TicketTheme Model
 *
 * @property \Cake\ORM\Association\HasMany $Ticket
 *
 * @method \App\Model\Entity\TicketTheme get($primaryKey, $options = [])
 * @method \App\Model\Entity\TicketTheme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TicketTheme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TicketTheme|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TicketTheme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TicketTheme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TicketTheme findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TicketThemeTable extends Table
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

        $this->table('ticket_theme');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Ticket', [
            'foreignKey' => 'ticket_theme_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        return $validator;
    }
}
