<?php

use PHPUnit\Framework\TestCase;

class GoogleScraperTest extends TestCase
{
    public function testGoogleScraperResults()
    {
        $query = urlencode("PHP Framework");
        $url = "https://www.googleapis.com/customsearch/v1?q={$query}&key=AIzaSyDJmWnC2Ln25Kqxnjy_qcQ4rcnkU3Chv_w&cx=9638f6645fffe407b";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        $this->assertNotEmpty($data['items']);
        $this->assertStringContainsString('PHP Framework', $data['items'][0]['title']);
    }
}