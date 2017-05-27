<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Mailer\Email;

/**
 * Ticket Controller
 *
 * @property \App\Model\Table\TicketTable $Ticket
 */
class TicketController extends AppController {
	
	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index() {
		$this->isAuthorized ( 2 );
		$tickets = $this->Ticket->find ( 'All' )->contain(['TicketTheme']);
// 		foreach ($tickets as $ticket){
// 			dd($ticket);	
// 		}
		
		$this->set ( compact ( 'tickets' ) );
	}
	
	/**
	 * View method
	 *
	 * @param string|null $id
	 *        	Ticket id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null) {
		$ticket = $this->Ticket->get ( $id, [ 
				'contain' => [ 
						'Users' 
				] 
		] );
		
		$this->set ( 'ticket', $ticket );
		$this->set ( '_serialize', [ 
				'ticket' 
		] );
	}
	
	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add() {
		$mail = Configure::read ( "Upload.Mail" );
		$this->loadModel ( "TicketTheme" );
		
		if ($this->request->is ( 'post' )) {
			
			$ticket = $this->Ticket->newEntity ();
			$user = $this->Auth->user ();
			if ($user) {
				$ticket->asker = $user ['nom'] . ' ' . $user ['prenom'];
				$ticket->email = $user ['email'];
				$ticket->user_id = $user ['id'];
			} else {
				$ticket->asker = htmlspecialchars ( $this->request->getData ( 'Ticket.asker' ) );
				$ticket->email = htmlspecialchars ( $this->request->getData ( 'Ticket.email' ) );
			}
			
			if ($this->request->getData ( 'Ticket.ticket_theme_id' ) == "autre" && $this->request->getData ( 'Ticket.theme' ) != "") { // autre theme
				$ticket->theme = htmlspecialchars ( $this->request->getData ( 'Ticket.theme' ) );
			} else {
				$theme = $this->TicketTheme->get ( $this->request->getData ( 'Ticket.ticket_theme_id' ) );
				$ticket->ticket_theme_id = $theme->id;
			}
			
			$ticket->question = htmlspecialchars ( $this->request->getData ( 'Ticket.question' ) );
			
			if (! $ticket->errors ()) {
				if ($this->Ticket->save ( $ticket )) {
					$this->Flash->success ( __ ( 'Ta demande a bien été envoyée et sera traitée dans les plus brefs délais' ) );
					$objet = "Nouveaud ticket sur gomines";
					$email = new Email ( 'default' );
					$email->from ( [ 
							'ticket@gomines.rez' => 'Gomines' 
					] );
					if (is_array ( $mail )) {
						foreach ( $mail as $m ) {
							$email->addTo ( $m );
						}
					} else {
						$email->to ( $mail );
					}
					
					$email->subject ( $objet );
					$email->send ( 'Un nouveau ticket a été créé sur gomines par ' . $ticket->asker .'\n '.$ticket->question );
					return $this->redirect ( [ 
							'controller' => 'Downloads',
							'action' => 'display' 
					] );
				} else {
					$this->Flash->error ( __ ( 'Le ticket n\'a pas pu être envoyé2' ) );
				}
			} else {
				
				$this->Flash->error ( __ ( 'Le ticket n\'a pas pu être envoyé1' ) );
				
				return $this->redirect ( [ 
						'controller' => 'Downloads',
						'action' => 'display' 
				] );
			}
		} else {
			return $this->redirect ( [ 
					'controller' => 'Downloads',
					'action' => 'display' 
			] );
		}
	}
	
	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	Ticket id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null) {
		$ticket = $this->Ticket->get ( $id, [ 
				'contain' => [ ] 
		] );
		if ($this->request->is ( [ 
				'patch',
				'post',
				'put' 
		] )) {
			$ticket = $this->Ticket->patchEntity ( $ticket, $this->request->data );
			if ($this->Ticket->save ( $ticket )) {
				$this->Flash->success ( __ ( 'The ticket has been saved.' ) );
				
				return $this->redirect ( [ 
						'action' => 'index' 
				] );
			} else {
				$this->Flash->error ( __ ( 'The ticket could not be saved. Please, try again.' ) );
			}
		}
		$users = $this->Ticket->Users->find ( 'list', [ 
				'limit' => 200 
		] );
		$this->set ( compact ( 'ticket', 'users' ) );
		$this->set ( '_serialize', [ 
				'ticket' 
		] );
	}
	
	/**
	 * Delete method
	 *
	 * @param string|null $id
	 *        	Ticket id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null) {
		$this->request->allowMethod ( [ 
				'post',
				'delete' 
		] );
		$ticket = $this->Ticket->get ( $id );
		if ($this->Ticket->delete ( $ticket )) {
			$this->Flash->success ( __ ( 'The ticket has been deleted.' ) );
		} else {
			$this->Flash->error ( __ ( 'The ticket could not be deleted. Please, try again.' ) );
		}
		
		return $this->redirect ( [ 
				'action' => 'index' 
		] );
	}
}
