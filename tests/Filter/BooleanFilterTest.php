<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\DoctrineMongoDBAdminBundle\Tests\Filter;

use Sonata\CoreBundle\Form\Type\BooleanType;
use Sonata\DoctrineMongoDBAdminBundle\Datagrid\ProxyQuery;
use Sonata\DoctrineMongoDBAdminBundle\Filter\BooleanFilter;

class BooleanFilterTest extends FilterWithQueryBuilderTest
{
    public function testFilterEmpty()
    {
        $filter = new BooleanFilter();
        $filter->initialize('field_name', ['field_options' => ['class' => 'FooBar']]);

        $builder = new ProxyQuery($this->getQueryBuilder());

        $filter->filter($builder, 'alias', 'field', null);
        $filter->filter($builder, 'alias', 'field', '');
        $filter->filter($builder, 'alias', 'field', 'test');
        $filter->filter($builder, 'alias', 'field', false);

        $filter->filter($builder, 'alias', 'field', []);
        $filter->filter($builder, 'alias', 'field', [null, 'test']);

        $this->assertFalse($filter->isActive());
    }

    public function testFilterNo()
    {
        $filter = new BooleanFilter();
        $filter->initialize('field_name', ['field_options' => ['class' => 'FooBar']]);

        $builder = new ProxyQuery($this->getQueryBuilder());

        $filter->filter($builder, 'alias', 'field', ['type' => null, 'value' => BooleanType::TYPE_NO]);

        $this->assertTrue($filter->isActive());
    }

    public function testFilterYes()
    {
        $filter = new BooleanFilter();
        $filter->initialize('field_name', ['field_options' => ['class' => 'FooBar']]);

        $builder = new ProxyQuery($this->getQueryBuilder());

        $filter->filter($builder, 'alias', 'field', ['type' => null, 'value' => BooleanType::TYPE_YES]);

        $this->assertTrue($filter->isActive());
    }

    public function testFilterArray()
    {
        $filter = new BooleanFilter();
        $filter->initialize('field_name', ['field_options' => ['class' => 'FooBar']]);

        $builder = new ProxyQuery($this->getQueryBuilder());

        $filter->filter($builder, 'alias', 'field', ['type' => null, 'value' => [BooleanType::TYPE_NO]]);

        $this->assertTrue($filter->isActive());
    }
}
