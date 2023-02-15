<?php

namespace App\Tests\Functional\Controller;

use App\Factory\DishPhotoFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testUploadingAFileAddsItToTheListOfRenderedImages(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/dish-photos');
        $dishPhoto = DishPhotoFactory::createOne();

        $client->followRedirects();

        $buttonCrawlerNode = $crawler->selectButton('Upload');

        $form = $buttonCrawlerNode->form();

        $form['dish_photo_form[title]'] = $dishPhoto->getTitle();
        $form['dish_photo_form[imageFile][file]'] = $dishPhoto->getImageFile();

        $client->submit($form);

        self::assertSelectorExists('img#'.$dishPhoto->getTitle().'-image');
        self::assertSelectorTextContains('figcaption#'. $dishPhoto->getTitle() . '-caption', $dishPhoto->getTitle());
    }
}
