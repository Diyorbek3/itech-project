<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;

class TelegramPolling extends Command
{
    protected $signature = 'telegram:poll';
    protected $description = 'Telegram bot polling mode';

    public function handle()
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        
        if (!$token) {
            $this->error("❌ TELEGRAM_BOT_TOKEN topilmadi!");
            return 1;
        }
        
        try {
            $telegram = new Api($token);
            $this->info("✅ Bot ishga tushdi!");
            $this->info("Bot token: " . substr($token, 0, 10) . "...");
            
            $lastUpdateId = 0;
            
            while (true) {
                $updates = $telegram->getUpdates(['offset' => $lastUpdateId + 1, 'timeout' => 30]);
                
                foreach ($updates as $update) {
                    $message = $update->getMessage();
                    if ($message) {
                        $chatId = $message->getChat()->getId();
                        $text = $message->getText();
                        $username = $message->getFrom()->getUsername() ?? $message->getFrom()->getFirstName();
                        
                        $this->info("📩 Xabar: " . ($text ?? 'fayl') . " | Chat ID: " . $chatId);
                        
                        if ($text === '/start') {
                            $telegram->sendMessage([
                                'chat_id' => $chatId,
                                'text' => "👋 Assalomu alaykum @{$username}!\n\nBotga rasm, video yoki fayl yuboring."
                            ]);
                            $this->info("✅ /start komandasi yuborildi");
                        }
                    }
                    $lastUpdateId = $update->getUpdateId();
                }
                
                sleep(1);
            }
        } catch (\Exception $e) {
            $this->error("Xatolik: " . $e->getMessage());
            sleep(3);
        }
    }
}