<?php

    namespace App\Http\Middleware;
    use Closure;
    use Exception;
    use Tymon\JWTAuth\Facades\JWTAuth;
    use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

    class JwtAdminMiddleware extends BaseMiddleware
    {

        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            try {
                $token = $request->get('token') ;
                $parse = JWTAuth::parseToken($token);//->toUser() - authenticate
                $payload = $parse->getPayload();
                if(array_key_exists('admin',$payload['user']))
                    $request->merge(['user'=>$payload['user']]);
                else
                    return response()->json(['login' => 'Token is Invalid']);
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    return response()->json(['login' => 'Token is Invalid']);
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    return response()->json(['login' => 'Token is Expired']);
                }else{
                    return response()->json(['login' => 'Authorization Token not found']);
                }
            }
            return $next($request);
        }
    }