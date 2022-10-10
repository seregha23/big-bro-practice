<?php

namespace console\models\parsers\mashableParser;

use Exception;
use HungCP\PhpSimpleHtmlDom\HtmlDomParser;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;

class Parser {
    protected string $urlDomain = 'https://mashable.com';

    protected string $url = 'https://mashable.com/tech';

    /**
     * @throws \yii\httpclient\Exception
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function execute(): ?array {
        $client = new Client();
        $response =  $client->createRequest()
            ->setMethod('Get')
            ->setUrl($this->url)
            ->send();

        if ($response->isOk) {
            $html = $response->getContent();
            $dom  = HtmlDomParser::str_get_html( $html );

            $contentStrip = $dom->find('.max-w-8xl.px-4.mx-auto.pb-8.mt-12[data-ga-module=content_strip]', 0);
            $urls         = [];
            foreach ($contentStrip->find('.flex-1') as $content) {
                $urls[] = $content->find('a[data-ga-label=Story Image]', 0)->getAttribute('href');
            }

            try {
                return $this->getData($urls);
            } catch (Exception $e) {
                echo 'Ошибка: ',  $e->getMessage(), "\n";
            }
        } else {
            throw new Exception('Ошибка при http-запросе');
        }
        return null;
    }

    /**
     * @throws \yii\httpclient\Exception
     * @throws InvalidConfigException
     * @throws Exception
     */
    protected function getData(array $urls): array {
        $data = [];
        foreach ($urls as $url) {
            $client = new Client();
            $response =  $client->createRequest()
                ->setMethod('Get')
                ->setUrl($this->urlDomain . $url)
                ->send();

            if ($response->isOk) {
                $html = $response->getContent();
                $dom  = HtmlDomParser::str_get_html( $html );
                $data[] = [
                    'title'       => $dom->find('h1', 0)->innertext(),
                    'description' => $dom->find('#article', 0)->innertext(),
                    'imgSrc'      => $dom->find('img', 0)->getAttribute('src'),
                ];
            } else {
                throw new Exception('Ошибка при обработке url');
            }
        }
        return $data;
    }

}