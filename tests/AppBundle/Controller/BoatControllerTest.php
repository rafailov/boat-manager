<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BoatControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        $this->markTestIncomplete();
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/boat/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /boat/");
        $crawler = $client->click($crawler->selectLink('Add a new boat')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Add Boat')->form(array(
            'boat[boatId]' => 103442,
            'boat[name]' => 'test name',
            'boat[price]' => 23.41,
            'boat[guests]' => 2,
            'boat[cabins]' => 3,
            'boat[bathrooms]' => 2,
            'boat[length]' => 13.50,
            'boat[about]' => 'the history of the boat is...',
            'boat[isActive]' => true,
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("the history of the boat is...")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form([
            'boat[boatId]' => 'boatId',
            'boat[name]' => 'test name 2',
            'boat[price]' => 'price',
            'boat[guests]' => 'guests',
        ]);

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[name="test name 2"]')->count(), 'Missing element [name="test name 2"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

}
