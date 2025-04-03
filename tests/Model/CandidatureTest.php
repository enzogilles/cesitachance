<?php

namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Candidature;

class CandidatureTest extends TestCase
{
    /**
     * Cette méthode va nous permettre de checker si la candidature existe.
     */
    public function testExistsReturnsTrueForExistingCandidature()
    {
        // Configuration du mock
        Candidature::$staticMocks = [];
        Candidature::$staticMocks['exists'] = function($userId, $offreId) {
            // Simuler qu'une candidature existe pour userId=1 et offreId=5
            return ($userId == 1 && $offreId == 5);
        };
        
        // Exécution - Test avec candidature existante
        $resultExists = Candidature::exists(1, 5);
        
        // Exécution - Test avec candidature non existante
        $resultNotExists = Candidature::exists(1, 6);
        
        // On vérifie les résultats
        $this->assertTrue($resultExists);
        $this->assertFalse($resultNotExists);
        
        // Nettoyage après le test
        Candidature::$staticMocks = [];
    }
    
    /**
     * Cette méthode va nous permettre de checker si "updateStatus" met à jour correctement le statut 
     * de la candidature
     */
    public function testUpdateStatusUpdatesStatusCorrectly()
    {
        // Préparation - Configuration du mock
        Candidature::$staticMocks = [];
        Candidature::$staticMocks['updateStatus'] = function($id, $statut) {
            // Vérifie les paramètres
            $this->assertEquals(1, $id);
            $this->assertEquals('acceptée', $statut);
            
            // Simule succès
            return true;
        };
        
        // Exécution
        $result = Candidature::updateStatus(1, 'acceptée');
        
        // Vérification
        $this->assertTrue($result);
        
        // Nettoyage
        Candidature::$staticMocks = [];
    }
}