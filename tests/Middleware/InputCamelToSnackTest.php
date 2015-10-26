<?php

class InputCamelToSnackTest extends TestCase
{
    public function testInputCamelToSnake()
    {
         $res = $this->call('POST', '/comments', [
            'lastName'        => 'Sconfield',
            'emailUser'       => 'user@example.com',
            'content_comment' => 'password',
            'urlcomment'      => 'url'
        ]);

         $this->assertEquals(200, $res->getStatusCode());
         $results = json_decode($res->getContent());
         $this->assertObjectHasAttribute('last_name', $results[0]);
         $this->assertObjectHasAttribute('email_user', $results[1]);
         $this->assertObjectHasAttribute('content_comment', $results[2]);
         $this->assertObjectHasAttribute('urlcomment', $results[3]);
    }
}
