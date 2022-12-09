<?php

namespace App\Services;

use Illuminate\Support\Str;
use PhpJunior\LaravelGlobalSearch\Facades\LaravelGlobalSearch;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class SearchService
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @var $string
     */
    private $query;

    /**
     * SearchService constructor.
     * @param $query
     */
    public function __construct($query)
    {
        $this->initRoutes();
        $this->query = $query;
    }

    /**
     * @return array
     */
    public function search()
    {
        $results = LaravelGlobalSearch::search($this->query);

        return $this->formatResults($results);
    }

    /**
     * init routes
     */
    private function initRoutes()
    {
        $this->routes = [
            // app(FaqCategory::class)->getTable() => 'faqCategory.edit',
        ];
    }

    /**
     * @param $results
     * @return array
     */
    private function formatResults($results)
    {
        $data = [];

        foreach ($results as $entities => $result) {
            foreach ($result as $item) {
                $title = array_values($item)[0] ?? '';
                $entity = Str::camel(Str::singular($entities));
                $category = str_replace('_', ' ', $entities);
                $route = route($this->getRouteName($entity), [
                    $entity => $item['id'] ?? null
                ]);

                $data[$category][] = [
                    'title' => $title,
                    'route' => $route,
                ];
            }
        }

        return $data;
    }

    /**
     * @param $entity
     * @return mixed
     */
    private function getRouteName($entity)
    {
        $entities = Str::plural($entity);
        $routeName = $this->routes[$entities] ?? $entity . '.edit';

        if (empty($routeName)) {
            throw new UnprocessableEntityHttpException('Invalid Entity');
        }

        return $routeName;
    }
}