<?php

namespace App\Controller;

use App\Form\HogeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SampleController extends AbstractController
{
    #[Route('/sample', name: 'app_sample')]
    public function index(Request $request): Response
    {
        $hoge_form = $this->createForm(HogeType::class, null, [
            // 「fuga必須 > はい/いいえ」に応じてルールを切り替えたい
            // しかしながら後続の$hoge_form->isValid()に対して意図通り機能しない
            // また「はい」を選んで画面再表示したときフォームでfuga入力が「はい/いいえ」によらず必須になってしまう
            'fuga_required' => 'yes' === ($request->get('hoge')['hoge_requires_fuga'] ?? ''),
        ]);

        $hoge_form->handleRequest($request);

        $validation_result = 'not submitted';
        if ($hoge_form->isSubmitted()) {
            // リクエスト受信時ではなく当該フォームを表示した際のオプション（リクエスト送信時のオプション）
            // のルールでバリデートされているようである
            $validation_result = $hoge_form->isValid() ? 'valid' : 'invalid';
        }

        return $this->render('sample/index.html.twig', [
            'controller_name' => 'SampleController',
            'hoge_form' => $hoge_form,
            'post_data' => $request->request->all(),
            'validation_result' => $validation_result,
        ]);
    }
}
