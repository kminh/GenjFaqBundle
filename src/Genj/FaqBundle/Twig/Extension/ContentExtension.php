<?php

/**
 * This file is part of the Kdm package.
 *
 * (c) 2015 Khang Minh <kminh@kdmlabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Genj\FaqBundle\Twig\Extension;

use Symfony\Component\Translation\TranslatorInterface;

use Genj\FaqBundle\Entity\QuestionRepository;
use Genj\FaqBundle\Controller\FaqController;

/**
 * @author Khang Minh <kminh@kdmlabs.com>
 */
class ContentExtension extends \Twig_Extension
{
    protected $controller;

    protected $translator;

    public function __construct(FaqController $controller, TranslatorInterface $translator)
    {
        $this->controller = $controller;
        $this->translator = $translator;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('faqs', array($this, 'getFaqs'), array(
                'is_safe' => array('html')
            ))
        );
    }

    public function getFaqs($categorySlug = null)
    {
        try {
            $response = $this->controller->indexWithoutCollapseAction($categorySlug);
            return $response->getContent();
        } catch (\Exception $e) {
            return $this->translator->trans($e->getMessage());
        }
    }

    public function getName()
    {
        return 'genj_content_extension';
    }
}
