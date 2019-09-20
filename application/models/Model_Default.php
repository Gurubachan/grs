<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 13-Oct-18
 * Time: 10:58 AM
 */

defined("BASEPATH") or exit("No direct script access allowed.");
set_time_limit(0);
class Model_Default extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function find_table($tblno){
        try{
            $table=array(
                1=>'tbl_grievence_type',
				2=>'tbl_sernder_receiver_type',
				3=>'tbl_sender_receiver_address',
				4=>'tbl_source',
				5=>'tbl_grievence',
				6=>'tbl_ministry',
				7=>'tbl_psu',
				8=>'tbl_department',
				9=>'tbl_send_to',
				10=>'tbl_division',
				11=>'tbl_message_type',
				12=>'tbl_seviority',
				13=>'tbl_referances',
				14=>'tbl_grievence_subtype'
            );
            if($table[$tblno]){
                return $table[$tblno];
            }else{
                return false;
            }
        }catch (Exception $exception){
		return	$message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
        }
    }
    public function select($tblno,$where=null,$orderby=null,$groupby=null,$limit=0,$distinct=null,$offset=0){
        try{
            $table=$this->find_table($tblno);
            if($table!=false){
                if($where!=null){
                    $this->db->where($where);
                }
                if($orderby!=null){
                    $this->db->order_by($orderby);
                }
                if($groupby!=null){
                    $this->db->group_by($groupby);
                }
                if($limit>0){
                    $this->db->limit($limit);
                    if($offset>0){
                        $this->db->offset($offset);
                    }
                }
                if($distinct!=null){
                	$this->db->distinct($distinct);
				}
                $response=$this->db->get($table);
                if($response->num_rows()>0){
                    //return $response->result();
					$message=array(
						'response'=>true,
						'message'=>$response->result()
					);
                }else{
					$message=array(
						'response'=>false,
						'message'=>'Unable to get any data from server'
					);

                }
            }else{
				$message=array(
					'response'=>false,
					'message'=>'Unable to find the table from database'
				);
            }
            return $message;
        }catch (Exception $e){
		return	$message=array(
				'response'=>false,
				'message'=>$e->getMessage()
			);
        }

    }
    /*public function insert($tblno,$data=array())
    {
        try{
            $table=$this->find_table($tblno);
            if($table!=false){
            	if(count($data)==1){
					$this->db->insert($table,$data[0]);
				}else{
					$this->db->insert_batch($table,$data);
				}

                if($this->db->affected_rows()>0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch (Exception $e)
        {
            echo "Message :".$e->getMessage();
        }
    }*/

	public function insert($tblno,$data=array())
	{
		try{
		    $this->db->trans_begin();
			$table=$this->find_table($tblno);
			if($table!=false){
				if(count($data)==1){
					$response=$this->db->insert($table,$data[0]);
                    if($this->db->affected_rows()>0){
                       $id=$this->db->insert_id();
                    }else{
                        $id=false;
                    }
					if($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $id=false;
                    }else{
                        $this->db->trans_commit();
                    }
					if($id!=false){
						$message=array(
							'response'=>true,
							'message'=>$id
						);
					}else{
						$message=array(
							'response'=>false,
							'message'=>'Unable to insert record, transaction rollback'
						);
					}

					return $message;

				}else{
					$this->db->insert_batch($table,$data);
                    $res=$this->db->affected_rows();
                    if($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $res=0;
                    }else{
                        $this->db->trans_commit();
                    }
					if($res>0){
						$message=array(
							'response'=>true,
							'message'=>'Record updated successfully'
						);
					}else{
						//return false;
						$message=array(
							'response'=>false,
							'message'=>'Unable to update record, transaction rollback'
						);
					}
				}
			}else{
				//return false;
				$message=array(
					'response'=>false,
					'message'=>'Unable to find table.'
				);
			}
			return $message;
		}catch (Exception $e)
		{
			//echo "Message :".$e->getMessage();
			return $message=array(
				'response'=>false,
				'message'=>$e->getMessage()
			);
		}
	}

    public function update($tblno,$data=array(),$column_name,$ids,$where=null)
    {
        try{
            $table=$this->find_table($tblno);
            if($table!=false){
                $this->db->set($data[0]);
                if($where!=null){
                    $this->db->where($where);
                }else{
                    $this->db->where_in($column_name,$ids);
                }
                $this->db->update($table);
                if($this->db->affected_rows()>0)
                {
                        //return $this->db->affected_rows();
						$message=array(
							'response'=>true,
							'message'=>$this->db->affected_rows()
						);
                }else{

					$message=array(
						'response'=>false,
						'message'=>'Unable to update record.'
					);
                }
            }else{
				$message=array(
					'response'=>false,
					'message'=>'Unable to found table'
				);
            }
            return $message;
        }catch (Exception $e)
        {
			$message=array(
				'response'=>false,
				'message'=>$e->getMessage()
			);
			return $message;
        }
    }
    public function query($query,$type=null){
        try{
            if($query!=""){
                $res=$this->db->query($query);
                if($type!=null){
                //return	$this->db->affected_rows();
					$message=array(
						'response'=>true,
						'message'=>$this->db->affected_rows()
					);
				}else{
					if($res->num_rows()>0){
						//return $res->result();
						$message=array(
							'response'=>true,
							'message'=>$res->result()
						);
					}else{
						$message=array(
							'response'=>false,
							'message'=>'No record found'
						);
					}
				}

            }else{
				$message=array(
					'response'=>false,
					'message'=>'Invalid query'
				);
            }
            return $message;
        }catch (Exception $e){
			$message=array(
				'response'=>true,
				'message'=>$e->getMessage()
			);
			return $message;
        }
    }

}
