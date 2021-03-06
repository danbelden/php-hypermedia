<?php

namespace Tests\Siren;

use Siren\Link;
use PHPUnit\Framework\TestCase;
use LogicException;

class LinkTest extends TestCase
{
    public function testRelGetAndSet()
    {
        $link = new Link();

        $newRel = array('new');
        $nowRel = $link->getRel();
        $this->assertNotEquals($newRel, $nowRel);

        $link->setRel($newRel);
        $updatedRel = $link->getRel();
        $this->assertEquals($newRel, $updatedRel);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided rel `1` is not a string
     */
    public function testSetRelThrowsAnExceptionIfANonStringSetItemIsProvided()
    {
        $link = new Link();
        $link->setRel(array(1));
    }

    public function testAddRelAppendsToRelArray()
    {
        $link       = new Link();
        $currentRel = $link->getRel();
        $this->assertEquals(array(), $currentRel);

        $link->addRel('test');
        $updatedRel = $link->getRel();
        $this->assertEquals(array('test'), $updatedRel);
    }

    public function testHrefGetAndSet()
    {
        $link = new Link();

        $newHref = 'new' ;
        $nowHref = $link->getHref();
        $this->assertNotEquals($newHref, $nowHref);

        $link->setHref($newHref);
        $updatedHref = $link->getHref();
        $this->assertEquals($newHref, $updatedHref);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided href `1` is not a string
     */
    public function testSetHrefThrowsAnExceptionIfANonStringProvided()
    {
        $link = new Link();
        $link->setHref(1);
    }

    public function testToArray()
    {
        $expexctedArray = array(
            'rel'  => array( 'self' ),
            'href' => 'http://api.x.io/orders/42'
        );

        $link = new Link();
        $link->setRel(array( 'self' ))
            ->setHref('http://api.x.io/orders/42');
        $actualArray = $link->toArray();

        $this->assertEquals($expexctedArray, $actualArray);
    }
}
