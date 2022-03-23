<?php

namespace App\Security;

use App\Repository\UzytkownikRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private UrlGeneratorInterface $urlGenerator;
    private UzytkownikRepository $uzytkownikRepository;

    public function __construct(UrlGeneratorInterface $urlGenerator, UzytkownikRepository $uzytkownikRepository)
    {
        $this->urlGenerator = $urlGenerator;
        $this->uzytkownikRepository = $uzytkownikRepository;
    }

    public function authenticate(Request $request): PassportInterface
    {
        $login = $request->request->get('login', '');

        $request->getSession()->set(Security::LAST_USERNAME, $login);
        $token = $request->get('_csrf_token');
        $password = $request->request->get('password', '');
        $check = $this->uzytkownikRepository->findOneBy([
            'login' => $login
        ]);


        if($check && $check->getStatus() === 1) {
            return new Passport(
                new UserBadge($login),
                new PasswordCredentials($password),
                [
                    new CsrfTokenBadge('authenticate', $token)
                ]
            );
        }
        else {
            throw new CustomUserMessageAuthenticationException('Konto nie istnieje, lub jest nieaktywne.');
        }
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        return new RedirectResponse($this->urlGenerator->generate('redirect_route'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
