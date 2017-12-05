<?php

namespace Fulcrum\Tests\Unit\Extender\WP;

use PHPUnit\Framework\TestCase;
use Fulcrum\Extender\WP\ParentChild;

class ParentChildTest extends TestCase
{
    public function testShouldReturnNullWhenAttemptinExtractWithNoID()
    {
        $stub = (object) [
            'id' => 10,
        ];
        $this->assertNull(ParentChild::extractPostId($stub));
        $this->assertNull(extract_post_id($stub));

        $stub = (object) [
            'postId' => 10,
        ];
        $this->assertNull(ParentChild::extractPostId($stub));
        $this->assertNull(extract_post_id($stub));
    }

    public function testShouldExtractPostIdFromObject()
    {
        $stub = (object) [
            'ID' => 10,
        ];
        $this->assertEquals(10, ParentChild::extractPostId($stub));
        $this->assertEquals(10, extract_post_id($stub));

        $this->assertEquals(5, ParentChild::extractPostId(new FooStub(5)));
        $this->assertEquals(42, extract_post_id(new FooStub(42)));
    }

    public function testExtractPostIdShouldReturnInt()
    {
        $this->assertEquals(10, ParentChild::extractPostId(10));
        $this->assertEquals(57, extract_post_id(57));

        $this->assertEquals(36, ParentChild::extractPostId('36'));
        $this->assertEquals(17, extract_post_id('17'));
    }
}