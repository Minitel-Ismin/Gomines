<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Film Model
 *
 * @method \App\Model\Entity\Film get($primaryKey, $options = [])
 * @method \App\Model\Entity\Film newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Film[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Film|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Film patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Film[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Film findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FilmTable extends Table
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

        $this->table('film');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->hasOne('Category',[
            'className' => 'Category',
            'foreignKey' => 'category_id',
        ]);
        $this->addBehavior('Timestamp');
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmpty('year');

        $validator
            ->integer('allocine_code')
            ->requirePresence('allocine_code', 'create')
            ->notEmpty('allocine_code');

        $validator
            ->requirePresence('directors', 'create')
            ->notEmpty('directors');

        $validator
            ->requirePresence('actors', 'create')
            ->notEmpty('actors');

        $validator
            ->requirePresence('path', 'create')
            ->notEmpty('path');

        $validator
            ->requirePresence('poster', 'create')
            ->notEmpty('poster');

        $validator
            ->requirePresence('allocine_link', 'create')
            ->notEmpty('allocine_link');

        $validator
            ->boolean('to_verify')
            ->requirePresence('to_verify', 'create')
            ->notEmpty('to_verify');

        return $validator;
    }
}
