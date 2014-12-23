<?php

namespace Kayue\Postmen\Object;

use InvalidArgumentException;

class Address extends AbstractObject
{
    protected $type;
    protected $taxId;
    protected $contactName;
    protected $contactPhone;
    protected $faxNumber;
    protected $email;
    protected $companyName;
    protected $addressLine1;
    protected $addressLine2;
    protected $addressLine3;
    protected $city;
    protected $state;
    protected $postalCode;
    protected $country;

    function __construct(array $options = [])
    {
        foreach ($options as $key => $value) {
            $this->$key = $value;
        }
    }

    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
    }

    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
    }

    public function getAddressLine3()
    {
        return $this->addressLine3;
    }

    public function setAddressLine3($addressLine3)
    {
        $this->addressLine3 = $addressLine3;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    public function getContactName()
    {
        return $this->contactName;
    }

    public function setContactName($contactName)
    {
        $this->contactName = $contactName;
    }

    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        if (strlen($country) !== 3) {
            throw new InvalidArgumentException('Invalid country code.');
        }

        $this->country = $country;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    public function setFaxNumber($fax_number)
    {
        $this->faxNumber = $fax_number;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getTaxId()
    {
        return $this->taxId;
    }

    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}
