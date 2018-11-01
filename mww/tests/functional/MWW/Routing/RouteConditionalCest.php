<?php

class RouteConditionalCest
{
    /**
     * Test RouteConditional works with array
     *
     * @param FunctionalTester $I
     * @throws \Codeception\Exception\ModuleException
     */
    public function it_should_route_a_request_by_array(FunctionalTester $I)
    {
        $code = <<<PHP
class Foo {
    public function bar()
    {
        echo 'Is bar!';
    }
}
add_filter('mww_conditional_routes', function(\$routes) {
    \$routes['is_front_page'] = ['Foo', 'Bar'];
    return \$routes;
});
PHP;
        $I->haveMuPlugin('my-routes.php', $code);
        $I->amOnPage('/');

        $I->see('Is bar!');
    }

    /**
     * Test RouteConditional works with string
     *
     * @param FunctionalTester $I
     * @throws \Codeception\Exception\ModuleException
     */
    public function it_should_route_a_request_by_string(FunctionalTester $I)
    {
        $code = <<<PHP
function test_routing() {
    echo 'Route tested!';
}
add_filter('mww_conditional_routes', function(\$routes) {
    \$routes['is_front_page'] = 'test_routing';
    return \$routes;
});
PHP;
        $I->haveMuPlugin('my-routes.php', $code);
        $I->amOnPage('/');

        $I->see('Route tested!');
    }

    /**
     * Test RouteConditional works with closure
     *
     * @param FunctionalTester $I
     * @throws \Codeception\Exception\ModuleException
     */
    public function it_should_route_a_request_by_closure(FunctionalTester $I)
    {
        $code = <<<PHP
add_filter('mww_conditional_routes', function(\$routes) {
    \$routes['is_front_page'] = function() {
        echo 'Closure is working!';
    };
    return \$routes;
});
PHP;
        $I->haveMuPlugin('my-routes.php', $code);
        $I->amOnPage('/');

        $I->see('Closure is working!');
    }
}
