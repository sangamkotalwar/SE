#include <string>
#include <fstream>
#include <iostream>
#include<vector>
#include<ctype.h>
#include<math.h>
#include <windows.h>
#include <mysql.h>
#include <sstream>
#include<algorithm>
#include<cstdlib>

using namespace std;

void finish_with_error(MYSQL *con)
{
  cout<<mysql_error(con)<<endl;
  mysql_close(con);
  exit(1);
}

const int AlPHABET_SIZE=26;
const int CASE='a';
int innerAB=0, innerAA=0, innerBB=0;

struct Node
{
    Node* parent = NULL;
    Node* children[26]= {};
    int occurences=0;
};

int partition(vector<float>& theList1,vector<int>& theList2,int start, int end)
{
	float pivot=theList1[end];
	int bottom = start-1;
	int top = end;
	bool notdone = true;
	int e2=theList2[end];
	while(notdone)
	{
		while(notdone)
		{
			bottom+=1;
			if(bottom==top)
			{
				notdone=false;
				break;
			}

	            	if (theList1[bottom]>pivot)
			{
	                	theList1[top]=theList1[bottom];
				theList2[top]=theList2[bottom];
	                	break;
		        }
	    	}
		while(notdone)
		{
	            	top=top-1;
			if(top==bottom)
			{
                		notdone=false;
	                	break;
	         	}
            		if(theList1[top]<pivot)
		        {
				theList1[bottom]=theList1[top];
				theList2[bottom]=theList2[top];
	        		break;
	         	}
	    	}
	}

	theList1[top]=pivot;
	theList2[top]=e2;

	return top;
}

//Actual function call within program

int quickSort(vector<float>& theList1,vector<int>& theList2,int start,int end)
{
	if (start<end)
	{
		int split=partition(theList1,theList2,start,end);   //recursion
	        quickSort(theList1,theList2,start,split-1);
	        quickSort(theList1,theList2,split+1,end);
	}
	else
	{
		return 0;
    	}

}

void InsertNode(Node* trieTree, string word)
{
    Node* currentNode= trieTree;
    for(string::iterator i=word.begin(); i!=word.end(); i++)
    {
        *i=tolower(*i);
    }
    if(word!="a" && word!="an" && word!="the" && word!="and" && word!="in" && word!="to")
    {

        string::iterator it=word.begin();
        while(it !=word.end() && ((*it>=97 && *it<=122)||(*it>=65 && *it<=90)))
        {
            //*it=tolower(*it);
            if(currentNode->children[*it - CASE]==NULL)
            {
                currentNode->children[*it - CASE]=new Node();
                currentNode->children[*it - CASE]->parent= currentNode;
            }

            currentNode= currentNode->children[*it - CASE];
            ++it;
        }

        ++(currentNode->occurences);

    }
    //cout<<"fuck";
}

int Search(Node* trieTree, vector<char> word)
{   int j;
    vector<char>::iterator it=word.begin();

    while(it != word.end())
    {
        if(trieTree->children[*it - CASE] != NULL)
        {
            trieTree=trieTree->children[*it - CASE];
            ++it;
        }
        else
            return 0;
    }
    j=trieTree->occurences;

    if(trieTree->occurences)
        return j;
    else
        return 0;
}

void PreOrderPrint(Node* trieTree, Node* trieTree_2, vector<char> word)
{
    if(trieTree->occurences && trieTree->parent)
    {
        for(vector<char>::iterator it= word.begin(); it != word.end(); ++it)
        {
            //cout<<*it;
        }
        //cout<<" "<<trieTree->occurences<<endl;
        int TT2occ;
        TT2occ=Search(trieTree_2, word);

        innerAB=innerAB+(trieTree->occurences*TT2occ);
        innerAA=innerAA+(trieTree->occurences*trieTree->occurences);
    }

    for(int i=0; i<AlPHABET_SIZE; i++)
    {
        if(trieTree->children[i] != NULL)
        {
            word.push_back(CASE + i);
            PreOrderPrint(trieTree->children[i], trieTree_2, word);
            word.pop_back();
        }
    }
}


int main(int argc, char* argv[])
{
    if(argc>1)
    {


     for(int i=1; i<argc; i++)
     {
         //cout<<argv[i]<<"\n";
     }

     MYSQL *con = mysql_init(NULL);

      if (con == NULL)
      {
          cout<<"mysql_init() failed\n";
          exit(1);
      }

      if (mysql_real_connect(con, "localhost", "root", "",
              "setest", 0, NULL, 0) == NULL)
      {
          finish_with_error(con);
      }

        string query;
        query="SELECT * FROM ";
        query+=argv[1];
        query+=" WHERE entity='";
        query+=argv[argc-2];
        query+="' AND scope='";
        query+=argv[argc-1];
        query+="'";
        //cout<<query;
        //query+=";
        //mysql_query(&mysql,query.c_str());

      if (mysql_query(con, query.c_str()))
      {
          finish_with_error(con);
      }

      MYSQL_RES *result = mysql_store_result(con);

      if (result == NULL)
      {
          finish_with_error(con);
      }

      int num_fields = mysql_num_fields(result);

      MYSQL_ROW row;

      Node* trieTree= new Node();

      const int SIZE = 1000;
      string words[SIZE];
      string str;
      int j;
      vector<char> word;
      vector<float>theList1;
      vector<int>theList2;
      float res;
      for(int i=2; i<argc-2; i++)
      {
          words[i-2]=argv[i];
          //cout<<words[i-2]<<" ";
      }
      j=argc-4;

      for (int m = 0; m <= j; ++m)
        {
            InsertNode(trieTree,words[m]);
        }


      while ((row = mysql_fetch_row(result)))
      {
          for(int i = 0; i < num_fields; i++)
          {
              if(row[i])
              {

                 if(i==5)
                 {

                      char* vec;
                      vec=row[i];
                      string t=row[i];
                      string t2=row[3];
                      t=t+" "+t2;
                      //cout<<vec;
                      //vec.push_back(*row[i]);
                      //cout<<*chava;

                      Node* trieTree_2= new Node();

                      istringstream iss(t);
                        string temp; int z=0;
                        while(iss >> temp) {
                            words[z]=temp;
                            //cout<<words[z]<<" ";
                            z++;
                        }
                        j=z;

                      for (int p = 0; p <= j; ++p)
                        {
                            InsertNode(trieTree_2,words[p]);
                        }

                      PreOrderPrint(trieTree, trieTree_2, word);
                      //cout<<"Inner Product of document 1 with document 1 is-"<<innerAA<<"\n";
                      //cout<<"Inner Product of document 1 with document 2 is-"<<innerAB<<"\n";
                      innerBB=innerAA;
                      innerAA=0;
                      innerAB=0;
                      PreOrderPrint(trieTree_2, trieTree, word);
                      //cout<<"Inner Product of document 2 with document 2 is-"<<innerAA<<"\n";
                      //cout<<"Inner Product of document 1 with document 2 is-"<<innerAB<<"\n";
                      //cout<<"Document Similarity measure is- "<<acos(innerAB/sqrt(innerAA*innerBB))<<"\n";
                      //cout<<"\nDocument 1 and 2 are "<<100-(acos(innerAB/sqrt(innerAA*innerBB))*200)/3.141592654<<" % similar\n";
                      //k++;
                      res=100-(acos(innerAB/sqrt(innerAA*innerBB))*200)/3.141592654;
                      if(res>0 && res<0.1)
                      {
                          res=0.0;
                      }
                      temp=row[0];
                      int r=atoi(&temp[0]);
                      theList1.push_back(res);
                      theList2.push_back(r);
                      innerAB=0, innerAA=0, innerBB=0;
                      //cout<<"---------------------------------------------------------------------------------------------";
                 }
              }

              else
                cout<<"NULL";
          }
              //cout<<"\n";
      }

      //sort (r.begin(), r.end());


    quickSort(theList1,theList2,0,theList1.size()-1);
    /*for(vector<float>::iterator it= theList1.begin(); it != theList1.end(); ++it)
        {
            cout<<*it<<" ";
        }*/

        for(vector<int>::reverse_iterator it= theList2.rbegin(); it != theList2.rend(); ++it)
        {
            cout<<*it<<" ";
        }






    mysql_free_result(result);
      mysql_close(con);

    }
    return 0;
}


