<?php
declare(strict_types=1);

namespace OpenBlogware\Tests\Page\Blog;

use PHPUnit\Framework\TestCase;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\HttpFoundation\Request;
use Werkl\OpenBlogware\Page\Blog\BlogPage;
use Werkl\OpenBlogware\Page\Blog\BlogPageLoadedEvent;

class BlogPageLoadedEventTest extends TestCase
{
    /**
     * This function tests that its possible to assign page correctly to our event.
     * This can be used by 3rd party developers, and the core system of
     * the plugin will then use that page when render blog detail page.
     */
    public function testPage(): void
    {
        $fakeSalesChannelContext = $this->getMockBuilder(SalesChannelContext::class)->disableOriginalConstructor()->getMock();

        $page = $this->createMock(BlogPage::class);

        $event = new BlogPageLoadedEvent(
            $page,
            $fakeSalesChannelContext,
            new Request()
        );

        static::assertEquals($page, $event->getPage());
        static::assertEquals($fakeSalesChannelContext, $event->getSalesChannelContext());
        static::assertInstanceOf(BlogPage::class, $event->getPage());
    }
}
