<?php

function getIdFromRelayId($relayID = ''){
  if ($relayID = ''){
    return 0;
  }
  $globalId = app('graphql.relay')->fromGlobalId($relayID);
  logi('$globalId');
  logi($globalId);
  // $typeName = $globalId['type'];
  return $id;
}

if (!function_exists('config_path')) {
    /**
     * @param $path
     */
    function config_path($path = '')
    {
        return app()->basePath().'/config'.($path ? '/'.$path : $path);
    }
}
if (!function_exists('app_path')) {
    /**
     * @param $path
     */
    function app_path($path = '')
    {
        return app()->basePath().'/app'.($path ? '/'.$path : $path);
    }
}
if (!function_exists('public_path')) {
    /**
     * @param $path
     */
    function public_path($path = '')
    {
        return app()->basePath().'/public'.($path ? '/'.$path : $path);
    }
}
if (!function_exists('logi')) {
    /**
     * @param $data
     */
    function logi($data)
    {
        \Log::info(transform_log($data));
    }
}
if (!function_exists('loge')) {
    /**
     * @param $data
     */
    function loge($data)
    {
        \Log::error(transform_log($data));
    }
}
if (!function_exists('logc')) {
    /**
     * @param $data
     */
    function logc($data)
    {
        \Log::critical(transform_log($data));
    }
}
if (!function_exists('transform_log')) {
    /**
     * @param $data
     * @return mixed
     */
    function transform_log($data)
    {
        if (is_array($data)) {
            return json_encode($data);
        } else {
            return $data;
        }
    }
}
