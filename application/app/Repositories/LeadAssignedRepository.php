<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for leads
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\LeadAssigned;
use Illuminate\Http\Request;
use Log;

class LeadAssignedRepository {

    /**
     * The assigned repository instance.
     */
    protected $assigned;

    /**
     * Inject dependecies
     */
    public function __construct(LeadAssigned $assigned) {
        $this->assigned = $assigned;
    }

    /**
     * Bulk delete assigned users for a particular project
     * @param int $lead_id the id of the lead
     * @return null
     */
    public function delete($lead_id = '') {

        //validations
        if (!is_numeric($lead_id)) {
            Log::error("validation error - invalid params", ['process' => '[LeadAssignedRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        $query = $this->assigned->newQuery();
        $query->where('leadsassigned_leadid', '=', $lead_id);
        $query->delete();
    }

    /**
     * assigned new users to a task
     * @param int $lead_id the id of the lead
     * @param int $user_id if specified, only this user will be assigned
     * @return array
     */
    public function add($lead_id = '', $user_id = '') {

        $list = [];

        //validations
        if (!is_numeric($lead_id)) {
            return $list;
        }

        //add only to the specified user
        if (is_numeric($user_id)) {
            $assigned = new $this->assigned;
            $assigned->leadsassigned_leadid = $lead_id;
            $assigned->leadsassigned_userid = $user_id;
            $assigned->save();
            $list[] = $user_id;
            //return array of users
            return $list;
        }

        //add each user in the post request
        if (request()->filled('assigned')) {
            foreach (request('assigned') as $user) {
                $assigned = new $this->assigned;
                $assigned->leadsassigned_leadid = $lead_id;
                $assigned->leadsassigned_userid = $user;
                $assigned->save();
                $list[] = $user;
            }
            //return array of users
            return $list;
        }

        //return array of users
        return $list;
    }

    /**
     * get all useers assigned to a task
     * @param numeric $id the id of the resource
     * @return object
     */
    // public function getAssigned($id = '') {

    //     //validations
    //     if (!is_numeric($id)) {
    //         return [];
    //     }

    //     $query = $this->assigned->newQuery();
    //     $query->leftJoin('users', 'users.id', '=', 'leads_assigned.leadsassigned_userid');
    //     $query->where('leadsassigned_leadid', $id);
    //     $query->orderBy('first_name', 'ASC');
    //     $assigned = $query->get();

    //     foreach($assigned as $assignee)
    //     {
    //         $user_id = $assignee->leadsassigned_userid;
    //         $assignee->total_leads = LeadAssigned::where('leadsassigned_userid',$user_id)->get()->count();
    //     }

    //     return $assigned;
    // }

    public function getAssigned($id = '') {
    // Validations
    if (!is_numeric($id)) {
        Log::error("Validation error - invalid lead ID", [
            'function' => __FUNCTION__,
            'lead_id' => $id
        ]);
        return [];
    }

        try {
            // Fetch assigned users with total lead count
            $assigned = $this->assigned
                ->leftJoin('users', 'users.id', '=', 'leads_assigned.leadsassigned_userid')
                ->select(
                    'users.id as user_id',
                    'users.first_name',
                    'users.avatar_directory',
                    'users.avatar_filename',
                    \DB::raw('(SELECT COUNT(*) FROM leads_assigned WHERE leads_assigned.leadsassigned_userid = users.id) as total_leads')
                )
                ->where('leads_assigned.leadsassigned_leadid', $id)
                ->orderBy('users.first_name', 'ASC')
                ->get();

            return $assigned;
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error("Error fetching assigned users", [
                'function' => __FUNCTION__,
                'lead_id' => $id,
                'error' => $e->getMessage()
            ]);

            return [];
        }
    }



    /**
     * assigned new users to a task
     * @param int $lead_id the id of the lead
     * @param int $user_id if specified, only this user will be assigned
     * @return array
     */
    public function update($new_leads) {

        $list = [];


        foreach ($new_leads as $new_lead){

            $assigned = new $this->assigned;
            $assigned->leadsassigned_leadid = $new_lead->lead_id;
            $assigned->leadsassigned_userid = $new_lead->lead_creatorid;
            $assigned->save();
        }

        //return array of users
        return $list;
    }
}