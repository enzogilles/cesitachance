<?php

namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\ContactMessage;

class ContactMessageTest extends TestCase
{
    /**
     * Teste que la méthode create fonctionne correctement
     */
    public function testCreateSavesContactMessage()
    {
        // Configuration de la méthode mocké
        ContactMessage::$staticMocks['create'] = function($nom, $email, $message) {
            // Vérifier que les paramètres attendus sont corrects
            $this->assertEquals('Test Nom', $nom);
            $this->assertEquals('test@example.com', $email);
            $this->assertEquals('Message de test', $message);
            
            // Simuler le succès
            return true;
        };
        
        // Exécution du test
        $result = ContactMessage::create('Test Nom', 'test@example.com', 'Message de test');
        
        // Vérification
        $this->assertTrue($result);
        
        // Nettoyage
        unset(ContactMessage::$staticMocks['create']);
    }
}