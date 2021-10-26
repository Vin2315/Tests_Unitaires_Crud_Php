<?php
namespace Test\dao;
require_once '../../vendor/autoload.php';

use App\models\VoitureDao;
use PHPUnit\Framework\TestCase;

class TestVoitureDao extends TestCase {

    private static $voitureDao;  
    
    public static function setUpBeforeClass() : void
    {
        TestVoitureDao::$voitureDao = new VoitureDao();
    }

    public static function tearDownAfterClass () : void
    {
        $voiture = TestVoitureDao::$voitureDao->findById (4);
        $voiture->setCouleur ("jaune");
        TestVoitureDao::$voitureDao->updateVoiture($voiture);
        TestVoitureDao::$voitureDao->insertVoiture2(2, "TR-654-WL", "jaune", "VW", "Golf");
        TestVoitureDao::$voitureDao->deleteVoiture(5);
    
    }


    public function testFindAll () {
        $voitures = TestVoitureDao::$voitureDao->findAll();
        $this->assertEquals(count($voitures),3);
    }

    public function testfindById () {
        $voiture = TestVoitureDao::$voitureDao->findById (2);
        $this->assertIsObject($voiture);
    }

    public function testUpdateVoiture () {
        $voiture = TestVoitureDao::$voitureDao->findById (4);
        $voiture->setCouleur ("rouge");
        TestVoitureDao::$voitureDao->updateVoiture($voiture);
        $voitureUpdated = TestVoitureDao::$voitureDao->findById (4);
        $this->assertEquals($voitureUpdated->getCouleur(),"rouge");
    }

    public function testDeleteVoiture () {
        $isDeleted = TestVoitureDao::$voitureDao->deleteVoiture (2);
        $this->assertTrue ($isDeleted);
    }

     public function testInsertVoiture2 () {
        $isInserted = TestVoitureDao::$voitureDao->insertVoiture2(5, "bleu", "BMW", "M1", "FD-694-LB");
        $this->assertEquals($isInserted,5);

     }
}