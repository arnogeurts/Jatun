<?php

namespace Jatun\SymfonyBundle\Twig\TokenParser;

use Jatun\SymfonyBundle\Twig\Node\JatunEventNode;
use Twig_Error_Syntax;
use Twig_Node;
use Twig_Token;

class JatunEventTokenParser extends \Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token A Twig_Token instance
     *
     * @return Twig_Node A Twig_Node instance
     *
     * @throws Twig_Error_Syntax
     */
    public function parse(Twig_Token $token)
    {
        $lineNo = $token->getLine();
        $stream = $this->parser->getStream();
        $event = $stream->expect(Twig_Token::NAME_TYPE)->getValue();

        $this->parser->pushLocalScope();
        $this->parser->pushBlockStack($event);

        $stream->next();
        $body = $this->parser->subparse(array($this, 'decideBlockEnd'), true);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        $this->parser->popBlockStack();
        $this->parser->popLocalScope();

        return new JatunEventNode($event, $body, $lineNo);
    }

    /**
     * @param Twig_Token $token
     * @return bool
     */
    public function decideBlockEnd(Twig_Token $token)
    {
        return $token->test('endjatun');
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'jatun';
    }
}