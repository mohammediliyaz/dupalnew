<?php


namespace Drupal\rsvplist\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class RSVPForm extends FormBase {

    public function getFormId(){
        return 'rsvplist_email_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state){

        $node = \Drupal::routeMatch()->getparameter('node');
        $nid = $node->nid->value;
        $form['email'] = array(
            '#title' => t('Email Address'),
            '#type' => 'textfield',
            '#size' => 25,
            '#description' => t("we'll send updates to the email you provide."),
            '#required' => TRUE,
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => t('RSVP'),
        );
        $form['nid'] = array(
            '#type' => 'hidden',
            '#value' => $nid,
        );

        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state){
        $value = $form_state->getValue('email');
        if($value == !\Drupal::service('email.validator')->isValid($value)){
            $form_state->setErrorByName('email',t('the email address %mail is not valid',array('%mail'=>$value)));
        }
    }


    public function submitForm(array &$form, FormStateInterface $form_state){
        $user = \Drupal\user\Entity\User::load(\drupal::currentUser()->id());
        db_insert('rsvplist')
            ->fields(array(
                'mail' => $form_state->getValue('email'),
                'nid' => $form_state->getValue('nid'),
                'uid' => $user->id('uid'),
                'created' => time(),
            ))
            ->execute();

         drupal_set_message(t('thankyou for your rsvp, now you are on list for the event'));
    }

}