<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Rakit\Validation\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Model\Order;
use App\Model\OperationType;

class OrderController extends AbstractController
{
    public function store(Request $request): RedirectResponse
    {
        $params = $request->request->all();

        $validator = new Validator();

        $validation = $validator->make($params, [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email',
            'phoneNumber' => 'regex:/^\+?[78][-\(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/',
            'currencyId' => 'required|integer|min:1',
            'operation' => [
                'required',
                $validator('in', ['buy', 'sell'])
            ],
            'changeResult' => 'required|numeric'
        ]);

        $validation->validate();

        session_start();

        if ($validation->fails()) {
            $_SESSION['message'] = 'Ваша заявка отклонена';
            return $this->redirect('/change');
        }

        [
            'name' => $name,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'currencyId' => $currencyId,
            'operation' => $operation,
            'changeResult' => $amount,
        ] = $params;

        $operationTypeId = OperationType::where('name', $operation)->value('id');

        $orderModel = new Order();
        $orderModel->name = $name;
        $orderModel->email = $email;
        $orderModel->phone_number = $phoneNumber;
        $orderModel->amount = (double) $amount;
        $orderModel->operation_type_id = (int) $operationTypeId;
        $orderModel->currency_id = (int) $currencyId;
        $orderModel->save();

        $_SESSION['message'] = 'Ваша заявка принята';
        return $this->redirect('/change');
    }
}
