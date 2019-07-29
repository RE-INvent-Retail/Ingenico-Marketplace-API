<?php

require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$wallets = new Marketplace\Resources\Wallet( $conn );

echo 'getAll:' . "\n";
$result = $wallets->getAll();
echo " -> wallet count " . count( $result ) . "\n";
print_r( $result );

echo "\n\n";

echo 'create:' . "\n";
$create_alias = 'mirakl_' . '2015';
$create_iban = 'DE11520513735120710131';
$create_bic = 'HELADEF1BOR';
$create_owner = 'Max Mustermann';
$wallet = new Marketplace\Objects\Wallet();
$wallet->setAlias( $create_alias );
$wallet->setWalletOwnerType( new Marketplace\Objects\Wallet\WalletOwnerType\Merchant() );
$bank_account = new Marketplace\Objects\Wallet\BankAccount();
$bank_account->setCurrency( new asdfklgash\IngenicoMarketplaceAPI\Objects\Currencies\EUR() );
$bank_account->setIban($create_iban );
$bank_account->setBic($create_bic);
$bank_account->setBankAccountOwner( $create_owner );
$wallet->addBankAccount( $bank_account );
$result = $wallets->create( $wallet );
if( $result === true )
    echo ' -> new ID: ' . $wallet->getWalletId() . "\n";
else
    echo 'error occured' . "\n" ;

echo "\n\n";

echo 'find:' . "\n";
$find_iban = $create_iban;
echo ' - IBAN = ' . $find_iban . "\n";
$result = $wallets->find( $find_iban, null );
echo " -> found " . count( $result ) . " wallets\n";
$find_alias = $create_alias;
echo ' - Alias = ' . $find_alias . "\n";
$result = $wallets->find( null, $find_alias );
echo " -> found " . count( $result ) . " wallets\n";

echo "\n\n";

echo 'getId:' . "\n";
$wallet_id = 321103902409;
$result = $wallets->get( $wallet_id );
print_r($result);

echo "\n\n";

echo 'getBalances:' . "\n";
$wallet_id = $wallet_id;
$wallet = new Marketplace\Objects\Wallet();
$wallet->setWalletId( $wallet_id );
$result = $wallets->getBalances( $wallet );
if( $result === true )
{
    print_r($wallet->getBalances());
}
else
    echo 'error occured';

echo "\n\n";

echo 'getBankAccounts:' . "\n";
$wallet_id = $wallet_id;
if( !empty( $wallet_id ) )
{
    $wallet = new Marketplace\Objects\Wallet();
    $wallet->setWalletId( $wallet_id );
    $result = $wallets->getBankAccounts( $wallet );
    if( $result === true )
        print_r($wallet->getBalances());
    else
        echo 'error occured';
}

echo "\n\n";


echo 'delete:' . "\n";
$wallet_id   = null;
if( !empty( $wallet_id ) )
{
    $wallet = new Marketplace\Objects\Wallet();
    $wallet->setWalletId( $wallet_id );
    $result = $wallets->delete( $wallet );
    if( $result === true )
    {
        echo 'deleted';
    }
    else
        echo 'error occured';
}

echo "\n\n";
