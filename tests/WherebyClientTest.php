<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Whereby\WherebyClient;
use Whereby\WherebyServiceProvider;

/**
 * @file
 * PHPUnit tests for Exception.
 */
abstract class WherebyClientTest extends TestCase {

    public function testWherebyFullProcess() {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);

        $startDate = new \DateTime('NOW');
        $startDate->add(new \DateInterval('PT1M'));
        $endDate = new \DateTime('NOW');
        $endDate->add(new \DateInterval('PT16M'));

        $meeting = (new WherebyClient())->startDate($startDate->format('Y-m-dTH:i:s') . 'Z')->endDate($endDate->format('Y-m-dTH:i:s') . 'Z')->fields(array())->createMeeting();
        $meetingArray = (array) json_decode($meeting);
        $this->assertArrayHasKey('meetingId', $meetingArray, 'Response Create Meeting => ' . $meeting);
        $getMeeting = (new WherebyClient())->getMeeting($meetingArray['meetingId']);
        $getMeetingArray = (array) json_decode($getMeeting);
        $this->assertArrayHasKey('meetingId', $getMeetingArray, 'Response Get Meeting => ' . $getMeeting);
        $deleteMeeting = (new WherebyClient())->deleteMeeting($meetingArray['meetingId']);
        $getMeeting2 = (new WherebyClient())->getMeeting($meetingArray['meetingId']);
        $getMeetingArray2 = (array) json_decode($getMeeting2);
        $this->assertArrayHasKey('error', $getMeetingArray2, 'Response Get Meeting after deleted => ' . $getMeeting2);
    }

    /**
     * @return Container
     */
    abstract protected function setupApplication();

    /**
     * @param Container $app
     *
     * @return AwsServiceProvider
     */
    private function setupServiceProvider($app) {
        // Create and register the provider.
        $provider = new WherebyServiceProvider($app);
        $app->register($provider);
        $provider->boot();

        return $provider;
    }

}
