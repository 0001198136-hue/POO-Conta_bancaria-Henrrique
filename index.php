<?php

class ContaBancaria {
    private $titular;
    private $numeroConta;
    private $saldo;

    // saldo sempre começa em 0
    public function __construct($titular, $numeroConta) {
        $this->titular = $titular;
        $this->numeroConta = $numeroConta;
        $this->saldo = 0;
    }

    // getters e setters (sem setSaldo, o saldo só muda por depositar e sacar)
    public function getTitular() {
        return $this->titular;
    }

    public function setTitular($titular) {
        $this->titular = $titular;
    }

    public function getNumeroConta() {
        return $this->numeroConta;
    }

    public function setNumeroConta($numeroConta) {
        $this->numeroConta = $numeroConta;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function depositar($valor) {
        if ($valor > 0) {
            $this->saldo += $valor;
            echo "Depósito de R$ " . number_format($valor, 2, ",", ".") . " realizado na conta de " . $this->titular . ".\n";
        } else {
            echo "Valor inválido para depósito.\n";
        }
    }

    public function sacar($valor) {
        if ($valor <= 0) {
            echo "Valor inválido para saque.\n";
        } elseif ($valor > $this->saldo) {
            echo "Saldo insuficiente.\n";
        } else {
            $this->saldo -= $valor;
            echo "Saque de R$ " . number_format($valor, 2, ",", ".") . " realizado na conta de " . $this->titular . ".\n";
        }
    }

    public function exibirInformacoes() {
        echo "Titular: " . $this->titular . "\n";
        echo "Número da conta: " . $this->numeroConta . "\n";
        echo "Saldo: R$ " . number_format($this->saldo, 2, ",", ".") . "\n";
        echo "\n";
    }
}

class BancoApp {
    public function main() {
        $conta1 = new ContaBancaria("Maria Silva", 1001);
        $conta2 = new ContaBancaria("João Souza", 1002);

        $conta1->exibirInformacoes();
        $conta2->exibirInformacoes();

        $conta1->depositar(500);
        $conta1->exibirInformacoes();

        $conta2->depositar(1200.50);
        $conta2->exibirInformacoes();

        $conta1->sacar(200);
        $conta1->exibirInformacoes();

        // saque maior que o saldo, deve dar saldo insuficiente
        $conta2->sacar(5000);
        $conta2->exibirInformacoes();

        // depósito negativo, deve ser recusado
        $conta1->depositar(-50);
        $conta1->exibirInformacoes();
    }
}

$app = new BancoApp();
$app->main();
