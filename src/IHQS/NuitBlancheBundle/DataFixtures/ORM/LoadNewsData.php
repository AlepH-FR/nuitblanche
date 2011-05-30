<?php

namespace IHQS\NuitBlancheBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use IHQS\NuitBlancheBundle\DataFixtures\BaseFixturesData;
use IHQS\NuitBlancheBundle\Entity\News;
use IHQS\NuitBlancheBundle\Entity\Comment;

class LoadNewsData extends BaseFixturesData implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 3;
    }

    public function doLoad()
    {
        $data = array();

        $o = new News();
        $o->setAuthor($this->getReference('player:AlepH')->getUser());
        $o->setDate(new \Datetime());
        $o->setTeam($this->getReference('team:nB.SC2'));
        $o->setTitle('Welcome on brand new nB) website !');
        $o->setBody("
            <p>
                    <strong>Welcome on our new website !</strong>
            </p>
            <p>
                    Nuit Blanche is quite an old team. We are playing like crazy since 1996 and let's guess we are geek enough to continue to play for decades.
                    Since 1996, we made MANY websites. Four versions with various success were made on the collector url <em>clannb.quakexpert.com</em>. Then when StarCraft 2 opened, we quickly created a small website
                    on <em>egame-star</em>.
            </p>
            <p>
                    But none of them was good enough for our exceptionnal team !<br />
                    So I decided to build a brand new one based on new powerful tools : Symfony 2, Doctrine 2 with some extra magical dust.
            </p>
            <p>
                    Here is a list of functions i hope you'll enjoy :
            </p>
            <ul>
                    <li>leagues and seasons recaps</li>
                    <li>detailled clan war page with related replays</li>
                    <li>detailled profiles with statistics, clan war games and replays related</li>
                    <li>cute replay page with apm chart, chat log and more</li>
                    <li>embedded stream pages, with live stream, show history, ...</li>
                    <li>... and more you'll discover while browsing this website</li>
            </ul>
            <p>
                    But we are still in a <strong>v0.9 beta version</strong> !<br />
                    Until the end of the summer, I'll add more cool stuff :
            </p>
            <ul>
                    <li>forum</li>
                    <li>replay notes and comments</li>
                    <li>internationalization for french only speakers (they suck I know !)</li>
            </ul>
            <p>
                    So..... I really hope you'll enjoy that shit and that you'll help us making it an active website.<br />
                    <em>Stay tuned</em>,<br />
                    AlepH
            </p>
        ");
        $data['news_1'] = $o;

        $this->registerObjects('news', $data);

        $data = array();

        $o = new Comment();
        $o->setAuthor($this->getReference('player:AlepH')->getUser());
        $o->setDate(new \Datetime());
        $o->setNews($this->getReference('news:news_1'));
        $o->setBody('And fill free to add some comments !');
        $data['comment_1'] = $o;

        $this->registerObjects('comments', $data);
    }
}