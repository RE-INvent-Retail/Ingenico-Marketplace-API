<?php

require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$wallets = new Marketplace\Resources\Wallet( $conn );

echo 'getAll:' . "\n";
$result = $wallets->getAll();
echo " -> wallet count " . count( $result ) . "\n";

echo "\n\n";

/*
echo 'create:' . "\n";
$wallet = new Marketplace\Objects\Wallet();
$wallet->setAlias( 'mirakl_' . '2015' );
$wallet->setWalletOwnerType( new Marketplace\Objects\Wallet\WalletOwnerType\Merchant() );
$bank_account = new Marketplace\Objects\Wallet\BankAccount();
$bank_account->setCurrency( new asdfklgash\IngenicoMarketplaceAPI\Objects\Currencies\EUR() );
$bank_account->setIban('DE11520513735120710131');
$bank_account->setBic('HELADEF1BOR');
$bank_account->setBankAccountOwner('Peter Beitzel' );
$wallet->addBankAccount( $bank_account );
$result = $wallets->create( $wallet );
if( $result === true )
    echo ' -> new ID: ' . $wallet->getWalletId() . "\n";
else
    echo 'error occured';
*/

echo "\n\n";

echo 'getId:' . "\n";
$wallet_id = 321103814806;
$result = $wallets->get( $wallet_id );
print_r($result);

echo "\n\n";

echo 'getBalances:' . "\n";
$wallet = new Marketplace\Objects\Wallet();
$wallet->setWalletId( 321103814806 );
$result = $wallets->getBalances( $wallet );
if( $result === true )
{
    print_r($wallet->getBalances());
}
else
    echo 'error occured';

echo "\n\n";

echo 'getBankAccounts:' . "\n";
$wallet = new Marketplace\Objects\Wallet();
$wallet->setWalletId( 321103814806 );
$result = $wallets->getBankAccounts( $wallet );
if( $result === true )
{
    print_r($wallet->getBalances());
}
else
    echo 'error occured';

echo "\n\n";


echo 'delete:' . "\n";
$wallet = new Marketplace\Objects\Wallet();
$wallet->setWalletId( 321103814806 );
$result = $wallets->delete( $wallet );
if( $result === true )
{
    echo 'deleted';
}
else
    echo 'error occured';

echo "\n\n";

