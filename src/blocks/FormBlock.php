<?php

namespace luya\bootstrap3\blocks;

use Yii;
use yii\helpers\Html;
use luya\helpers\Url;
use luya\bootstrap3\Module;
use luya\bootstrap3\BaseBootstrap3Block;
use luya\bootstrap3\blockgroups\Bootstrap3Group;

/**
 * Form generation Block.
 *
 * @author Basil Suter <basil@nadar.io>
 * @since 1.0.0
 */
final class FormBlock extends BaseBootstrap3Block
{
    public $defaultNameLabel = 'Name';
    
    public $defaultNamePlaceholder = 'First and Last Name';
    
    public $defaultNameError = 'Please enter a name';

    public $defaultEmailLabel = 'Email';
    
    public $defaultEmailPlaceholder = 'beispiel@beispiel.ch';
    
    public $defaultEmailError = 'Please enter an email address';

    public $defaultMessageLabel = 'Message';
    
    public $defaultMessageError = 'Please enter a message';

    public $defaultSendLabel = 'Send';

    public $defaultSendError = 'Sorry, an error occurred while sending the message.';

    public $defaultSendSuccess = 'Many thanks! We will get in touch with you.';

    public $defaultMailSubject = 'Contact Inquiry';
    
    public function blockGroup()
    {
        return Bootstrap3Group::class;
    }

    public function name()
    {
        return Module::t("block_form_name");
    }

    public function icon()
    {
        return 'email';
    }

    public function config()
    {
        return [
            'vars' => [
                ['var' => 'emailAddress', 'label' => 'Email will be sent to the following address', 'type' => 'zaa-text'],
                ['var' => 'headline', 'label' => 'Heading', 'type' => 'zaa-text', 'placeholder' => 'Contact'],
                ['var' => 'nameLabel', 'label' => 'Text for field "Name"', 'type' => 'zaa-text', 'placeholder' => $this->defaultNameLabel],
                ['var' => 'emailLabel', 'label' => 'Text for field "Email"', 'type' => 'zaa-text', 'placeholder' => $this->defaultEmailLabel],
                ['var' => 'messageLabel', 'label' => 'Text for field "Message"', 'type' => 'zaa-text', 'placeholder' => $this->defaultMessageLabel],
                ['var' => 'sendLabel', 'label' => 'Text on the submit button', 'type' => 'zaa-text', 'placeholder' => $this->defaultSendLabel],
            ],

            'cfgs' => [
                ['var' => 'subjectText', 'label' => 'Subject in the email', 'type' => 'zaa-text', 'placeholder' => $this->defaultMailSubject],
                ['var' => 'namePlaceholder', 'label' => 'Placeholder in the field "Name"', 'type' => 'zaa-text', 'placeholder' => $this->defaultNamePlaceholder],
                ['var' => 'emailPlaceholder', 'label' => 'Placeholder in the field "Email"', 'type' => 'zaa-text', 'placeholder' => $this->defaultEmailPlaceholder],
                ['var' => 'nameError', 'label' => 'Error message for field "Name"', 'type' => 'zaa-text', 'placeholder' => $this->defaultNameError],
                ['var' => 'emailError', 'label' => 'Error message for field "Email"', 'type' => 'zaa-text', 'placeholder' => $this->defaultEmailError],
                ['var' => 'messageError', 'label' => 'Error message for field "Message"', 'type' => 'zaa-text', 'placeholder' => $this->defaultMessageError],
                ['var' => 'sendSuccess', 'label' => 'Confirmation text after submitting the form', 'type' => 'zaa-text', 'placeholder' => $this->defaultSendSuccess],
                ['var' => 'sendError', 'label' => 'Error text after failed attempt to send the form', 'type' => 'zaa-text', 'placeholder' => $this->defaultSendError],
            ],
        ];
    }

    public function extraVars()
    {
        return [
            'nameLabel' => $this->getVarValue('nameLabel', $this->defaultNameLabel),
            'namePlaceholder' => $this->getCfgValue('namePlaceholder', $this->defaultNamePlaceholder),
            'nameError' => $this->getCfgValue('nameError', $this->defaultNameError),
            'emailLabel' => $this->getVarValue('emailLabel', $this->defaultEmailLabel),
            'emailPlaceholder' => $this->getCfgValue('emailPlaceholder', $this->defaultEmailPlaceholder),
            'emailError' => $this->getCfgValue('emailError', $this->defaultEmailError),
            'messageLabel' => $this->getVarValue('messageLabel', $this->defaultMessageLabel),
            'messageError' => $this->getCfgValue('messageError', $this->defaultMessageError),
            'sendLabel' => $this->getVarValue('sendLabel', $this->defaultSendLabel),
            'sendError' => $this->getCfgValue('sendError', $this->defaultSendError),
            'sendSuccess' => $this->getCfgValue('sendSuccess', $this->defaultSendSuccess),
            'subjectText' => $this->getCfgValue('subjectText', $this->defaultMailSubject),
            'message' => Yii::$app->request->post('message'),
            'name' => Yii::$app->request->post('name'),
            'email' => Yii::$app->request->post('email'),
            'mailerResponse' => $this->getPostResponse(),
            'csrf' => Yii::$app->request->csrfToken,
            'nameErrorFlag' => Yii::$app->request->isPost ? (Yii::$app->request->post('name') ? 1 : 0): 1,
            'emailErrorFlag' => Yii::$app->request->isPost ? (Yii::$app->request->post('email') ? 1 : 0): 1,
            'messageErrorFlag' => Yii::$app->request->isPost ? (Yii::$app->request->post('message') ? 1 : 0): 1,
        ];
    }

    public function sendMail($message, $email, $name)
    {
        $email = Html::encode($email);
        $name = Html::encode($name);
        
        $html = "<p>You have recieved an E-Mail via Form Block on " . Url::base(true)."</p>";
        $html.= "<p>From: " . $name." ($email)<br />Time:".date("d.m.Y - H:i"). "<br />";
        $html.= "Message:<br />" . nl2br(Html::encode($message)) ."</p>";
        
        $mail = Yii::$app->mail;
        $mail->fromName = $name;
        $mail->from = $email;
        $mail->compose($this->getVarValue('subjectText', $this->defaultMailSubject), $html);
        $mail->address($this->getVarValue('emailAddress'));

        if (!$mail->send()) {
            return 'Error: '.$mail->error;
        } else {
            return 'success';
        }
    }

    public function getPostResponse()
    {
        $request = Yii::$app->request;

        if (Yii::$app->request->isPost) {
            if ($request->post('message') && $request->post('email') && $request->post('name')) {
                return $this->sendMail($request->post('message'), $request->post('email'), $request->post('name'));
            }
        }
    }
    
    public function admin()
    {
        return  '<p><i>Form Block</i></p>{% if vars.emailAddress is not empty %}'.
                    '{% if vars.headline is not empty %}<h3>{{ vars.headline }}</h3>{% endif %}'.
                        '<div class="input input--text">'.
                            '<label for="name" class="input__label">{{ extras.nameLabel }}</label>'.
                            '<div class="input__field-wrapper"><input id="name" class="input__field" disabled="disabled" /></div>'.
                        '</div>'.
                        '<div class="input input--text">'.
                        '<label for="name" class="input__label">{{ extras.emailLabel }}</label>'.
                        '<div class="input__field-wrapper"><input id="name" class="input__field" disabled="disabled" /></div>'.
                        '</div>'.
                        '<div class="input input--text">'.
                        '<label for="name" class="input__label">{{ extras.messageLabel }}</label>'.
                        '<div class="input__field-wrapper"><textarea class="input__field" disabled="disabled" /></div>'.
                        '</div>'.
                        '<button class="btn" disabled>{{ extras.sendLabel }}</button>'.
                    '{% else %}<span class="block__empty-text">There is no email address yet</span>'.
                '{% endif %}';
    }
}
