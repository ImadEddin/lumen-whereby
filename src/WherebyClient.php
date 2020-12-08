<?php

namespace Whereby;

/**
 * Description of WherebyClient
 *
 * @author Adel Jerbi <adel.jerbi@we-conect.com>
 */
class WherebyClient {

    protected $isLocked;
    protected $roomNamePrefix;
    protected $roomNamePattern;
    protected $roomMode;
    protected $startDate;
    protected $endDate;
    protected $fields;

    public function isLocked($isLocked): self {
        $this->isLocked = $isLocked;

        return $this;
    }

    public function roomNamePrefix($roomNamePrefix): self {
        $this->roomNamePrefix = $roomNamePrefix;

        return $this;
    }

    public function roomNamePattern($roomNamePattern): self {
        $this->roomNamePattern = $roomNamePattern;

        return $this;
    }

    public function roomMode($roomMode): self {
        $this->roomMode = $roomMode;

        return $this;
    }

    public function startDate($startDate): self {
        $this->startDate = $startDate;

        return $this;
    }

    public function endDate($endDate): self {
        $this->endDate = $endDate;

        return $this;
    }

    public function fields($fields): self {
        $this->fields = $fields;

        return $this;
    }

    public function createMeeting() {

        $post_data = array(
            'isLocked' => empty($this->isLocked) ? false : $this->isLocked,
            'roomNamePrefix' => empty($this->roomNamePrefix) ? NULL : $this->roomNamePrefix,
            'roomNamePattern' => empty($this->roomNamePattern) ? NULL : $this->roomNamePattern,
            'roomMode' => empty($this->roomMode) ? 'normal' : $this->roomMode,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'fields' => empty($this->fields) ? array() : $this->fields,
        );
        $client = new \Whereby\Client(config('whereby.wherebyApiToken'));
        return $client->createRequest('POST', "meetings")
                        ->attachBody($post_data)
                        ->execute();
    }

    public function getMeeting($meetingId) {

        $client = new \Whereby\Client(config('whereby.wherebyApiToken'));
        return $client->createRequest('GET', "meetings/" . $meetingId)
                        ->execute();
    }

    public function deleteMeeting($meetingId) {

        $client = new \Whereby\Client(config('whereby.wherebyApiToken'));
        return $client->createRequest('DELETE', "meetings/" . $meetingId)
                        ->execute();
    }

}
