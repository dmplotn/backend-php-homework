<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\CBRFPeriodRatesLoader;
use Carbon\Carbon;
use App\Model\CurrencyRate;
use App\Model\Currency;
use WouterJ\EloquentBundle\Facade\Db;

class LoadCurrencyRatesCommand extends Command
{
    protected function configure()
    {
        $this->setName('app:load-rates');
        $this->setDescription('Load currency rates by CBRF api and save them in the db.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $now = Carbon::now();
        $yearAgo = $now->copy()->subYear();

        $columnItems = Currency::select('cbrf_id')->get();

        $loader = new CBRFPeriodRatesLoader();

        $io = new SymfonyStyle($input, $output);
        $io->progressStart(count($columnItems));

        Db::beginTransaction();

        CurrencyRate::truncate();

        try {
            foreach ($columnItems as $item) {
                $rates = $loader->load($yearAgo, $now, $item->cbrf_id);

                foreach ($rates as $rate) {
                    $currencyId = Currency::where('cbrf_id', $rate['cbrf_id'])->value('id');
                    $currencyRateModel = new CurrencyRate();
                    $currencyRateModel->currency_rate = $rate['rate'];
                    $currencyRateModel->date = Carbon::createFromFormat('d.m.Y', $rate['date']);
                    $currencyRateModel->currency_id = $currencyId;
                    $currencyRateModel->save();
                }

                $io->progressAdvance();
            }
        } catch (\Exception $e) {
            $io->error('An error occurred while loading data.');
            return Command::FAILURE;
        }

        Db::commit();

        $io->progressFinish();
        $io->success('Currency rates loaded.');
        return Command::SUCCESS;
    }
}
