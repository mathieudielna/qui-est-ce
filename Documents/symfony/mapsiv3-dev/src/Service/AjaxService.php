<?php
// namespace App\Service;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Validator\Validator\ValidatorInterface;

// use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
// use Symfony\Component\Serializer\Serializer;
// use Symfony\Component\Serializer\Encoder\JsonEncoder;

// class AjaxService
// {

//     private $validator;
//     public function __construct(ValidatorInterface $validator)
//     {
//         $this->validator = $validator;
//     }

//     public function validateAndCreate($data, $entityClassName){

//         $objectNormalizer = new ObjectNormalizer();
//         $normalizers = [$objectNormalizer];
//         $encoders = [new JsonEncoder()];
//         $serializer = new Serializer($normalizers, $encoders);

//         $result = $serializer->deserialize($data, $entityClassName, 'json');
//         $errors = $this->validator->validate($result);

//         if(count($errors) > 0){
//             throw new CustomApiException(Response::HTTP_BAD_REQUEST, (string) $errors);
//         }

//         return $result;

//     }
// }